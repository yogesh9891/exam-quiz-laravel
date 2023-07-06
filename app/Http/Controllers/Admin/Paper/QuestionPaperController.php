<?php

namespace App\Http\Controllers\Admin\Paper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paper\OuestionPaperSaveRequest;
use Illuminate\Http\Request;
use App\Models\QuestionPaper;
use App\Models\Template;
use App\Models\Question;
use App\Models\Paper;
use App\Models\SchoolGroup;
use App\Models\User;
use App\Models\AssignedPaper;
use App\Events\PaperAssignEvent;

class QuestionPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question_papers = QuestionPaper::with('template','paper')->get();
        return view('admin.template.question-paper.index',compact('question_papers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $templates =Template::all();
        return view('admin.template.question-paper.create',compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OuestionPaperSaveRequest $request)
    {
        $data = $request->validated();
        $pid =1;
           $template = Template::find($data['template_id']);
        foreach ($data['question_id'] as $key => $id) {
           $data['question_id'] = $id;
           // dd($data);
           // dd($template);    
           if($key==0){

               $que =   QuestionPaper::where('template_id',$data['template_id'])->where('paper_id',$data['paper_id'])->latest()->first();
               if($que){
                $pid = $que->position +1;
               }
           }
                $data['position'] = $pid;
                 $data['creater'] = auth()->user()->name;
        $questions_paper = QuestionPaper::create($data);
        $questions_paper->update(['number'=>$template->number.'-'.$pid]);
        }
         return redirect()->route('question-paper.index')->with('message','Question Paper are created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $questions_paper = QuestionPaper::with('question')->where('number',$id)->get();
         $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($questions_paper[0]->template_id);
         $paper = Paper::findOrFail($questions_paper[0]->paper_id);
         $school_groups = SchoolGroup::all();

        return view('admin.template.question-paper.show',compact('questions_paper','template','paper','school_groups'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $questions_paper = QuestionPaper::with('paper','template','question')->where('number',$id)->get();
       $papers = Paper::where('template_id',$questions_paper[0]->template_id)->get();
       $all_questions = Question::withCount('sub_questions')->where('template_id',$questions_paper[0]->template_id)->get();

        $templates =Template::all();
       return view('admin.template.question-paper.edit',compact('questions_paper','templates','papers','all_questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OuestionPaperSaveRequest $request, $number)
    {
        $ques_paper =   QuestionPaper::where('number',$number)->first();

        $data = $request->validated();
        foreach ($data['question_id'] as $key => $id) {
           $data['question_id'] = $id;
           $data['position'] = $ques_paper->position;
           $data['number'] = $ques_paper->number;
           $data['creater'] = auth()->user()->name;
        
               $que =   QuestionPaper::where('number',$number)->where('question_id',$id)->first();
               if(!$que){
                       $questions_paper = QuestionPaper::create($data);
                
               }
           }
             
        
         return redirect()->route('question-paper.index')->with('message','Question Paper are updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_question(Template $template)
    {
        $papers = Paper::where('template_id',$template->id)->get();
        $questions = Question::withCount('sub_questions')->where('template_id',$template->id)->get();

        $paper_html= '';
        $questions_html= '<select class=" form-control" id="selectpicker" ><option  value="">--Select Question--</option>';
        foreach($questions as $question){
                   $questions_html.= '<option value="'.$question->id.'">'.$question->instruction.' (No. of SubQuestion is '.$question->sub_questions_count.')</option>';
                  
        }      
      $questions_html .='</select>';

       $paper_html= '<select class=" form-control"  name="paper_id"><option  value="">--Select Paper Top part--</option>';
        foreach($papers as $paper){
                   $paper_html.= '<option value="'.$paper->id.'">'.$paper->name .'  </option>';
                  
        }      
      $paper_html .='</select>';

      return response()->json(['success'=>true,'paper_html'=>$paper_html,'questions_html'=>$questions_html]);

    }

    public function delete_question(Request $request)
    {
      QuestionPaper::destroy($request->id);
        return response()->json(['success'=>true]);
    }

    public function get_school($school_group_id)
    {
        $school_group = SchoolGroup::with('schools')->findOrFail($school_group_id);
        $school_html = ' <option>--Select School ---</option>';
        if($school_group->schools){
            foreach ($school_group->schools as $key => $school) {
                if($school->user){

                  $school_html .= '<option value="'.$school->user->id.'">'.$school->name.' </option>';
                }
            }
        }

        return response()->json(['success'=>true,'html'=>$school_html]);
    }

    public function get_class($school_id)
    {
        $school =User::with('classes')->findOrFail($school_id);
     $class_html = ' <option>--Select class ---</option>';
        if($school->classes){
            foreach ($school->classes as $key => $class) {
                if($class->class){

                  $class_html .= '<option value="'.$class->id.'">'.$class->class->name.'</option>';
                }
            }
        }

        return response()->json(['success'=>true,'html'=>$class_html]);
    }

    public function paper_assigned(Request $request)
    {
        $school_group_id = $request->school_group_id;
        $school_id = $request->school_id;
        $class_id = $request->class_id;
        $question_paper_id = $request->question_paper_id;
        $template_id = $request->template_id;
        $paper_assigned = AssignedPaper::where('school_group_id',$school_group_id)->where('school_id',$school_id)->where('class_id',$class_id)->where('question_paper_id',$question_paper_id)->first();

        if($paper_assigned){
               return response()->json(['success'=>false]);
        }

        $paper_assigned = new AssignedPaper;
        $paper_assigned->school_group_id = $school_group_id;
        $paper_assigned->school_id = $school_id;
        $paper_assigned->class_id = $class_id;
        $paper_assigned->question_paper_id = $question_paper_id;
        $paper_assigned->template_id = $template_id;
        // $paper_assigned->creater = auth()->user()->name;
        $paper_assigned->save();
           event(new PaperAssignEvent($paper_assigned));

        return response()->json(['success'=>true]);
    }
}
