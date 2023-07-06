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
use Auth;

class TeacherController extends Controller
{
    //

    protected  $teacher;
    protected  $user;

    public function __construct(Request $request)
    {
           $this->middleware(function ($request, $next) {
                           $this->user = Auth::user();
                       return $next($request);
            });

    }

    public function classes()
    {

            $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();

         $sections = Section::with('class','section')->withCount('section_student')->where('teacher_id', $this->teacher->teacher_id)->get();
       return view('teacher.class',compact('sections'));
    } 


       public function students()
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
         $sections = Section::with('class','section','section_student')->where('teacher_id',$this->teacher->teacher_id)->get();
      
       return view('teacher.students',compact('sections'));
    } 


    public function papers()
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();

          $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');
          if($sections){

          $class_array = array_keys($sections->toArray());
          $question_papers = AssignedPaper::with('school_group','question_paper','class','school')->whereIn('class_id',$class_array)->get();
          }
      return view('teacher.paper.index',compact('question_papers'));
          

     }

         public function sent_back_papers()
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();

          $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');
          if($sections){

          $class_array = array_keys($sections->toArray());
          $question_papers = AssignedPaper::with('school_group','question_paper','class','school')->whereIn('class_id',$class_array)->get();
          }
      return view('teacher.paper.index',compact('question_papers'));
          

     }


       public function student_papers(Request $request)
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();

          
          $student_assigneds = StudentAssigned::with('student','teacher','assigned_paper','class','section','student_paper')->where('teacher_id',$this->teacher->teacher_id)->where('question_paper_id',$request->number)->get();

              return view('teacher.paper.sent.students',compact('student_assigneds'));
          

     }

     public function section_papers(Request $request)
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();

          
          $section_assigneds = StudentAssigned::with('class','section')->where('teacher_id',$this->teacher->teacher_id)->where('question_paper_id',$request->number)->get()->unique('section_id');

              return view('teacher.paper.sent.section',compact('section_assigneds'));
          

     }

        public function sent_papers()
    {
          $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();

          
          $student_assigned = StudentAssigned::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('question_paper_id');
     
          if($student_assigned){
            $paper_array = array_keys($student_assigned->toArray());
         
          $question_papers = AssignedPaper::with('school_group','question_paper','class','school')->whereIn('id',$paper_array)->get();
          }
      return view('teacher.paper.sent',compact('question_papers'));
          

     }

        public function paper_show($id)
    {
       $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
         $assigned_paper = AssignedPaper::with('school_group','question_paper','class','school')->findOrFail($id);
         $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($assigned_paper->question_paper->template_id);
         $sections = Section::with('class','section')->where('teacher_id', $this->teacher->teacher_id)->get();
         $paper = Paper::findOrFail($assigned_paper->question_paper->paper_id);

        return view('teacher.paper.show',compact('assigned_paper','template','paper','sections'));
    }

    public function question_comment(Request $request)
    {
       $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
       $comment = '';
        $question = SubQuestion::with('instruction')->findOrFail($request->id);
           $questions_paper = AssignedPaper::where('question_paper_id',$request->number)->first();
      // dd($questions_paper->school_id,$this->teacher->school_id);
           if($questions_paper->school_id != $this->teacher->school_id){
               abort(403);
           }

           $comment = QuestionComment::where(['teacher_id'=>$this->teacher->teacher_id,'question_paper_id'=>$request->number,'question_id'=>$question->question_id,'sub_question_id'=>$request->id])->first();
        if($comment){

                        if($request->isMethod('put')){
                         $data = $request->validate([
                              'comment'=>'required',
                         ]);

                         $comment->comment    = $request->comment;
                         $comment->save();
                        
                       return redirect()->route('teacher.papers')->with('message','Question Comment updted successfully');
         }
           return view('teacher.paper.question',compact('question','comment'));
        }



        if($request->isMethod('post')){
          $data = $request->validate([
               'comment'=>'required',
          ]);

          $comment = new QuestionComment;
          $comment->teacher_id = $this->teacher->teacher_id;
          $comment->question_paper_id  = $request->number;
          $comment->question_id   = $question->question_id;
          $comment->sub_question_id    = $request->id;
          $comment->comment    = $request->comment;
          $comment->save();
         
        return redirect()->route('teacher.papers')->with('message','Question Comment submiited successfully');
         }
        

        return view('teacher.paper.question',compact('question','comment'));
    }

    public function get_students($section_id)
    {
        $section = Section::with('section_student','section')->findOrFail($section_id);

             $class_html = ' <option value="">--Select Student ---</option>';
        if($section->section_student){
            foreach ($section->section_student as $key => $student) {
                if($student->user){

                  $class_html .= '<option value="'.$student->user->id.'">'.$student->user->name.'</option>';
                }
            }
        }

        return response()->json(['success'=>true,'html'=>$class_html]);
    }

    public function sent_to_all(Request $request)
    {

        $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
        // dd($request->all());
        $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');
          if($sections){

          $class_array = array_keys($sections->toArray());
          $classes = Section::with('section','class','section_student')->whereIn('class_id',$class_array)->get();

              if(!$classes){

                         return redirect()->back()->with('message','Class not found successfully');
              }
// dd($classes);
    
            foreach ($classes as  $section) {

          if($section->section_student){
            foreach ($section->section_student as $key => $student) {
                if($student->user){
                        $assigned_paper = AssignedPaper::with('question_paper')->findOrFail($request->number);

                        $student_assigned = StudentAssigned::where(['question_paper_id'=>$request->number,'teacher_id'=>$this->user->id,'section_id'=>$section->id,'student_id'=>$student->user->id])->first();
                        if(!$student_assigned){
                               
                        $student_assigned = new StudentAssigned;
                        $student_assigned->question_paper_id = $request->number;
                        $student_assigned->teacher_id  = $this->user->id;
                        $student_assigned->class_id   = $section->class_id;
                        $student_assigned->section_id    = $section->id;
                        $student_assigned->student_id   = $student->user->id;
                        $student_assigned->save();
                        
                        }
                  }
            }
        }
             
        }
     }
       return redirect()->back()->with('message','Paper assiend to section successfully');
    }

     public function sent_to_section(Request $request)
    {
        $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
        // dd($request->all());
        $section = Section::with('class','section','section_student')->findOrFail($request->section_id);
          if($section->section_student){
            foreach ($section->section_student as $key => $student) {
                if($student->user){
                        $assigned_paper = AssignedPaper::with('question_paper')->findOrFail($request->number);

                        $student_assigned = StudentAssigned::where(['question_paper_id'=>$request->number,'teacher_id'=>$this->user->id,'section_id'=>$request->section_id,'student_id'=>$student->user->id])->first();
                        if(!$student_assigned){
                               
                        $student_assigned = new StudentAssigned;
                        $student_assigned->question_paper_id = $request->number;
                        $student_assigned->teacher_id  = $this->user->id;
                        $student_assigned->class_id   = $section->class_id;
                        $student_assigned->section_id    = $request->section_id;
                        $student_assigned->student_id   = $student->user->id;
                        $student_assigned->save();
                        
                        }
                  }
            }
        }

       return redirect()->back()->with('message','Paper assiend to section successfully');
    }

     public function sent_to_student(Request $request)
    {
        // dd($request->all());
        $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
        $section = Section::with('class','section')->findOrFail($request->section_id);
        $student = SchoolStudent::with('user')->where('student_id',$request->student_id)->firstOrFail();
        if($student->user){
            $assigned_paper = AssignedPaper::with('question_paper')->findOrFail($request->question_paper_id);

            $student_assigned = StudentAssigned::where(['question_paper_id'=>$request->question_paper_id,'teacher_id'=>$this->user->id,'section_id'=>$request->section_id,'student_id'=>$request->student_id])->first();
            if($student_assigned){
                    return response()->json(['success'=>false]);
            }
            $student_assigned = new StudentAssigned;
            $student_assigned->question_paper_id = $request->question_paper_id;
            $student_assigned->teacher_id  = $this->user->id;
            $student_assigned->class_id   = $section->class_id;
            $student_assigned->section_id    = $request->section_id;
            $student_assigned->student_id   = $student->user->id;
            $student_assigned->save();
             return response()->json(['success'=>true]);

        }
    }

    public function show_paper($id)
    {
       
    }


}
