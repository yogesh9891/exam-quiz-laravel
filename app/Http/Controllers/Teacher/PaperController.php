<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolTeacher;
use App\Models\Section;
use App\Models\AssignedPaper;;
use App\Models\QuestionPaper;
use App\Models\SubQuestion;
use App\Models\Template;
use App\Models\Paper;
use App\Models\QuestionComment;
use App\Models\SchoolStudent;
use App\Models\StudentAssigned;
use App\Models\StudentPaper;
use App\Models\AnswerComment;
use Auth;
//cqgslgtuqzhfhmwl
class PaperController extends Controller
{

    protected  $teacher;
    protected  $user;

    public function __construct(Request $request)
    {
           $this->middleware(function ($request, $next) {
                           $this->user = Auth::user();
                       return $next($request);
            });

    }

    public function browse_papers()
    {
         $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
         $teacher =$this->teacher;
          $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');
          if($sections){

          $class_array = array_keys($sections->toArray());
          $question_papers = AssignedPaper::with('school_group','question_paper','class','school')->whereIn('class_id',$class_array)->get();
          }
           return view('teacher.paper.index',compact('teacher','class_array'));
    }

         public function paper_show($id)
    {
       $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
         $assigned_paper = AssignedPaper::with('school_group','question_paper','class','school','section_assigned')->findOrFail($id);
         $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($assigned_paper->question_paper->template_id);
         $sections = Section::with('class','section','section_student')->where('teacher_id', $this->teacher->teacher_id)->get();
         $paper = Paper::findOrFail($assigned_paper->question_paper->paper_id);
        return view('teacher.paper.show',compact('assigned_paper','template','paper','sections'));
    }

            public function assigned_papers()
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();

          
          $student_assigned = StudentAssigned::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('question_paper_id');
          if($student_assigned){
            $paper_array = array_keys($student_assigned->toArray());
             $question_papers = AssignedPaper::with('template','question_paper','class','section_assigned')->whereIn('id',$paper_array)->get();
          }
  
      return view('teacher.paper.assigned',compact('question_papers'));
          

     }

             public function recieved_papers()
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
          //   $sections = Section::with('class','section')->withCount('section_student','assigned_papers','submit_papers')->where('teacher_id', $this->teacher->teacher_id)->get();
          
          // $question_papers = StudentPaper::with('student_assigned_paper','question_paper','student_assigned_paper.class','student_assigned_paper.section','student_assigned_paper.assigned_paper.section_assigned')->whereHas('student_assigned_paper',function($q)  {
          //               $q->whereIn('status',['submit','resubmit']);
          //           })->where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('assigned_paper_id');
                    $student_assigned = StudentAssigned::select('question_paper_id','teacher_id','class_id','section_id','status')->with('assigned_paper.question_paper','class.class','section.section')->where('teacher_id',$this->teacher->teacher_id)->get()->groupBy(['assigned_paper.question_paper.number','assigned_paper.template.title','class.class.name','section.section.name']);
     
             


      return view('teacher.paper.recieved',compact('student_assigned'));
          

     }
    public function paper_assigned(Request $request,$id)
    {
       // dd($request->all());

          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
        // dd($request->all());
          if($request->type=='all'){
               $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');

                     if($sections){
                          $class_array = array_keys($sections->toArray());
                          $classes = Section::with('section','class','section_student')->whereIn('class_id',$class_array)->get();

                          if(!$classes){

                                     return response()->json(['success'=>false]);
                          }
                
            foreach ($classes as  $section) {

          if($section->section_student){
                        foreach ($section->section_student as $key => $student) {
                            if($student->user){
                                    $assigned_paper = AssignedPaper::with('question_paper')->findOrFail($id);

                                    $student_assigned = StudentAssigned::where(['question_paper_id'=>$id,'teacher_id'=>$this->user->id,'section_id'=>$section->id,'student_id'=>$student->user->id])->first();
                                    if(!$student_assigned){
                                           
                                    $student_assigned = new StudentAssigned;
                                    $student_assigned->question_paper_id = $id;
                                    $student_assigned->teacher_id  = $this->user->id;
                                    $student_assigned->class_id   = $section->class_id;
                                    $student_assigned->section_id    = $section->id;
                                    $student_assigned->student_id   = $student->user->id;
                                    $student_assigned->submit_to   = $request->date;
                                    $student_assigned->save();
                                    
                                    }
                              }
                        }
                    }
             
                    }
                 }

                  return response()->json(['success'=>true]);
          }
          if($request->type=='class'){

                    $classes = Section::with('section','class','section_student')->where('class_id',$request->id)->get();

                          if(!$classes){

                                     return response()->json(['success'=>false]);
                          }
                
            foreach ($classes as  $section) {

          if($section->section_student){
                        foreach ($section->section_student as $key => $student) {
                            if($student->user){
                                    $assigned_paper = AssignedPaper::with('question_paper')->findOrFail($id);

                                    $student_assigned = StudentAssigned::where(['question_paper_id'=>$id,'teacher_id'=>$this->user->id,'section_id'=>$section->id,'student_id'=>$student->user->id])->first();
                                    if(!$student_assigned){
                                           
                                    $student_assigned = new StudentAssigned;
                                    $student_assigned->question_paper_id = $id;
                                    $student_assigned->teacher_id  = $this->user->id;
                                    $student_assigned->class_id   = $section->class_id;
                                    $student_assigned->section_id    = $section->id;
                                    $student_assigned->student_id   = $student->user->id;
                                    $student_assigned->submit_to   = $request->date;
                                    $student_assigned->save();
                                    
                                    }

                              }
                        }
                    }
             
                    }

           return response()->json(['success'=>true]);

          }
          if($request->type=='section'){

                    $section = Section::with('class','section','section_student')->findOrFail($request->id);
                          if($section->section_student){
                            foreach ($section->section_student as $key => $student) {
                                if($student->user){
                                        $assigned_paper = AssignedPaper::with('question_paper')->findOrFail($id);

                                        $student_assigned = StudentAssigned::where(['question_paper_id'=>$id,'teacher_id'=>$this->user->id,'section_id'=>$request->id,'student_id'=>$student->user->id])->first();
                                        if(!$student_assigned){
                                               
                                        $student_assigned = new StudentAssigned;
                                        $student_assigned->question_paper_id = $id;
                                        $student_assigned->teacher_id  = $this->user->id;
                                        $student_assigned->class_id   = $section->class_id;
                                        $student_assigned->section_id    = $request->id;
                                        $student_assigned->student_id   = $student->user->id;
                                         $student_assigned->submit_to   = $request->date;
                                        $student_assigned->save();
                                        
                                        }
                                  }
                            }
                        }

                 return response()->json(['success'=>true]);
          }
          if($request->type=='student'){
              $student = SchoolStudent::with('user')->findOrFail($request->id);

                if($student->user){
            $assigned_paper = AssignedPaper::with('question_paper')->findOrFail($id);

            $student_assigned = StudentAssigned::where(['question_paper_id'=>$id,'teacher_id'=>$this->user->id,'section_id'=>$student->section_id,'student_id'=>$student->student_id])->first();
            if($student_assigned){
                    return response()->json(['success'=>false]);
            }
            $student_assigned = new StudentAssigned;
            $student_assigned->question_paper_id = $id;
            $student_assigned->teacher_id  = $this->user->id;
            $student_assigned->class_id   = $student->class_id;
            $student_assigned->section_id    = $student->section_id;
            $student_assigned->student_id   = $student->user->id;
            $student_assigned->submit_to   = $request->date;
            $student_assigned->save();
             return response()->json(['success'=>true]);

        }
          }
    }

   public function get_students(Request $request)
    { 
        $term = $request->term;
        $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
         $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');
          if($sections)
          {
            $class_array = array_keys($sections->toArray());
         }
          $students = SchoolStudent::whereHas('user',function($q) use ($term) {
                        $q->where('name', 'like', '%'.$term.'%')->orderBy('name','asc');
                    })->with('user','class','section')->whereIn('class_id',$class_array)->get();
          
          $html ='<ul>';
          foreach($students as $student){
            $html .= '<li class="search-li" data-id="'.$student->id.'">'.$student->user->name.' ('.$student->class->class->name.'-'.$student->section->section->name. ') </li>';
          }

          $html .='</ul>';
   

        return response()->json(['success'=>true,'html'=>$html]);
    }



     public function student_papers(Request $request)
     {

          $this->teacher =  SchoolTeacher::where('teacher_id',$this->user->id)->firstOrFail();
          $status = [];
            if($request->type =='assigned'){
            $status = ['assign','saved'];
          }
          if($request->type =='recieved'){
            $status = ['submit','resubmit'];
          }
           if($request->type =='sent'){
            $status = ['sent','sent_saved'];
          }

            if($request->type =='archived'){
            $status = ['checked'];
          }
        $student_assigneds = StudentAssigned::with('student')->where('teacher_id',$this->teacher->teacher_id)->where('section_id',$request->section)->where('question_paper_id',$request->question_paper)->whereIn('status',$status)->get();

        $section = Section::find($request->section);
       return view('teacher.paper.student_papers',compact('student_assigneds','section'));
     }


     
     public function student_answer($id)
     {
          $this->teacher =  SchoolTeacher::where('teacher_id',$this->user->id)->firstOrFail();
             $student_assigned = StudentAssigned::with('assigned_paper','section.class.class','student','section.section','student_paper')->where('teacher_id',$this->teacher->teacher_id)->findorFail($id);
            
          // $student_paper = StudentPaper::with('student_assigned_paper','student_answers','student')->where('student_assigned_id',$id)->firstOrFail();
          if($student_assigned->status =='resubmit'){

            return view('teacher.paper.re_answer',compact('student_assigned'));
          }
          if($student_assigned->status =='checked'){

            return view('teacher.paper.checked',compact('student_assigned'));
          }

         return view('teacher.paper.answer',compact('student_assigned'));
     }

         public function paper_comment(Request $request)
    {
       $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
 
           $student_paper = StudentPaper::findOrFail($request->paper_id);
  
                        if($student_paper->comment){

                         $student_paper->comment2    = $request->comment;
                        }else{

                         $student_paper->comment    = $request->comment;
                        }
                         $student_paper->save();
                        
                        // return response()->json(['success'=>true,'msg'=>'Question Comment updated successfully']);
                       return redirect()->back()->with('message','Paper Commented  successfully');
         
        }

        public function answer_comment(Request $request)
    {
       $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
       $comment = '';
        $question = SubQuestion::with('instruction')->findOrFail($request->question_id);
           $student_paper = StudentPaper::where('student_assigned_id',$request->number)->where('teacher_id',$this->teacher->teacher_id)->firstOrFail();
      // dd($questions_paper->school_id,$this->teacher->school_id);
// dd($request->all());
        
           $comment = AnswerComment::where(['teacher_id'=>$this->teacher->teacher_id,'student_assigned_id'=>$request->number,'sub_question_id'=>$request->question_id,'student_answer_id'=>$request->id])->first();
        if($comment){
                        if($request->isMethod('put')){
                         $data = $request->validate([
                              'comment'=>'required',
                         ]);

                         $comment->comment    = $request->comment;
                         $comment->save();
                        
                        // return response()->json(['success'=>true,'msg'=>'Question Comment updated successfully']);
                       return redirect()->back()->with('message','Question Comment updted successfully');
         }
        }



        if($request->isMethod('post')){
          $data = $request->validate([
               'comment'=>'required',
          ]);
// dd($request->all());
          $comment = new AnswerComment;
          $comment->teacher_id = $this->teacher->teacher_id;
          $comment->student_id = $student_paper->student_id;
          $comment->student_assigned_id  = $request->number;
          $comment->sub_question_id   = $request->question_id;
          $comment->student_answer_id    = $request->id;
          $comment->comment    = $request->comment;
          $comment->save();
         
                       return redirect()->back()->with('message','Question commented successfully');
           // return response()->json(['success'=>true,'msg'=>'Question commented  successfully']);
         }
        

        // return view('teacher.paper.question',compact('question','comment'));
    }

    public function student_paper_action(Request $request,$id)
    {
         $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
             $student_assigned = StudentAssigned::where('teacher_id',$this->teacher->teacher_id)->findorFail($id);

             $type = $request->type;
             if($type =='checked'){
                if($request->error){
                    $student_assigned->error_tag = 1;

                }

                if($request->paper_id){
                      $student_paper = StudentPaper::findOrFail($request->paper_id);
                        if($student_paper->comment){

                         $student_paper->comment2    = $request->comment;
                        }else{

                         $student_paper->comment    = $request->comment;
                        }
                         $student_paper->save();
                }
                $student_assigned->status = 'checked';
              $student_assigned->save();
              return redirect()->route('teacher.papers.sent_back')->with('message','Paper Accept successfully');
             }
             elseif($type =='sent_back'){

                $student_assigned->status = 'sent';
                $student_assigned->sent_tag = 1;


             $student_assigned->save();
              return redirect()->route('teacher.papers.sent_back')->with('message','Paper Sent Back For Action successfully');
             }

            
    }

    public function sent_back_papers(){

         $this->teacher =  SchoolTeacher::where('teacher_id',$this->user->id)->firstOrFail();
     $student_assigned = StudentAssigned::select('question_paper_id','teacher_id','class_id','section_id','status')->with('assigned_paper.question_paper','class.class','section.section')->where('teacher_id',$this->teacher->teacher_id)->whereIn('status',['sent','sent_saved'])->get()->groupBy(['assigned_paper.question_paper.number','class.class.name','section.section.name']);

      return view('teacher.paper.sent',compact('student_assigned'));
    }

               public function archived_papers()
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
        $this->teacher =  SchoolTeacher::where('teacher_id',$this->user->id)->firstOrFail();
     $student_assigned = StudentAssigned::select('question_paper_id','teacher_id','class_id','section_id','status')->with('assigned_paper.question_paper','class.class','section.section')->where('teacher_id',$this->teacher->teacher_id)->whereIn('status',['checked'])->get()->groupBy(['assigned_paper.question_paper.number','class.class.name','section.section.name']);

      return view('teacher.paper.archived',compact('student_assigned'));



          

     }

}
//