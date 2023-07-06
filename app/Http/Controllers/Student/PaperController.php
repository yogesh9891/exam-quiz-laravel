<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Http\Requests\Paper\PaperAnswerRequest;
use App\Models\User;
use App\Models\SchoolTeacher;
use App\Models\Section;
use App\Models\AssignedPaper;;
use App\Models\QuestionPaper;
use App\Models\SubQuestion;
use App\Models\Template;
use App\Models\Paper;
use App\Models\QuestionRecheck;
use App\Models\SchoolStudent;
use App\Models\StudentAssigned;
use App\Models\StudentPaper;
use App\Models\StudentAnswer;
use App\Models\StudentNewAnswer;
use Auth;

class PaperController extends Controller
{
	 protected  $student;
    protected  $user;

    public function __construct(Request $request)
    {
           $this->middleware(function ($request, $next) {
                           $this->user = Auth::user();
                       return $next($request);
            });

    }
    
    public function papers()
    {
          $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();

          $question_papers = StudentAssigned::with('student','teacher','assigned_paper','class','section')->where('student_id',$this->user->id)->get();
          
     		 return view('student.paper.index',compact('question_papers'));
          

     }
        public function assign_papers()
    {
          $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();

          $question_papers = StudentAssigned::with('student','teacher','assigned_paper','class','section')->where('student_id',$this->user->id)->whereIn('status',['assign','sent'])->get();
          
             return view('student.paper.index',compact('question_papers'));
          

     }

            public function saved_papers()
    {
              $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();

              $question_papers = StudentAssigned::with('student','teacher','assigned_paper','class','section')->where('student_id',$this->user->id)->whereIn('status',['saved','sent_saved'])->get();
                return view('student.paper.index',compact('question_papers'));
          

     }

          public function sent_papers()
    {
     		 $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
                 $question_papers = StudentAssigned::with('student','teacher','assigned_paper','class','section')->where('student_id',$this->user->id)->whereIn('status',['submit','sent','resubmit'])->get();
              return view('student.paper.sent',compact('question_papers'));
          

     }

           public function checked_papers()
    {
             $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
            $question_papers = StudentAssigned::with('student','teacher','assigned_paper','class','section')->where('student_id',$this->user->id)->where('status','checked')->get();
                return view('student.paper.index',compact('question_papers'));
          

     }

             public function sent_back_papers()
    {
             $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();

            $question_papers = StudentAssigned::with('student','teacher','assigned_paper','class','section')->where('student_id',$this->user->id)->whereIn('status',['sent_back','sent'])->get();

                return view('student.paper.index',compact('question_papers'));
          

     }




        public function paper_show($id)
    {
      		 $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
         $student_assigned = StudentAssigned::with('assigned_paper','class','section')->where('student_id',$this->student->student_id)->findOrFail($id);
         $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($student_assigned->assigned_paper->question_paper->template_id);
         $sections = Section::with('class','section')->where('teacher_id', $student_assigned->teacher_id)->get();
         $paper = Paper::findOrFail($student_assigned->assigned_paper->question_paper->paper_id);



        return view('student.paper.show',compact('student_assigned','template','paper','sections'));
    }


    public function paper_submit(Request $request,$number)
    {  	
    	$this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
    	$student_assigned = StudentAssigned::with('assigned_paper','class','section')->where('student_id',$this->student->student_id)->findOrFail($number);
    	// $erros = [];
    	//   foreach($student_assigned->assigned_paper->question_paper->question_paper as $no =>$question){
    	//   	      foreach($question->question->sub_questions as $key =>$que){
     //                           $lettter = chr($key+65);
     //                           $num = ($no+1).'-'.$lettter;
    	//   	      	if (!array_key_exists($que->id,$request->answer)){
    	//   	      		$erros[$num] = ' Please choose this question';
    	//   	      	}
    	//   	      }
    	//   }
    	  

                      if(count($request->answer) <1){

                        return back()->withInput($request->input())->with('message','Please choose at least one anwser');
                      }
                     
   
            $student_paper = StudentPaper::where(['assigned_paper_id'=>$student_assigned->question_paper_id ,'student_assigned_id'=>$number,'student_id'=>$this->student->student_id,'question_paper_id'=>$student_assigned->assigned_paper->question_paper->id])->first();
            if(!$student_paper){
                    $student_paper = StudentPaper::firstOrCreate(['assigned_paper_id'=>$student_assigned->question_paper_id  ,'student_assigned_id'=>$number,'student_id'=>$this->student->student_id,'question_paper_id'=>$student_assigned->assigned_paper->question_paper->id]);

            	  foreach ($request->answer as $key => $value) {
            	  	$stu_ans =  $student_paper->student_answers()->where(['student_id'=>$this->student->student_id,'sub_question_id'=>$key,'answer'=>$value])->first();
                    if(!$stu_ans){
                    $student_paper->student_answers()->create(['student_id'=>$this->student->student_id,'sub_question_id'=>$key,'answer'=>$value]);
                      }
            	  }

                  $student_assigned->status = 'saved';
                  $student_assigned->update();
            }
    	   return redirect()->route('student.papers.saved')->with('message','Paper save  successfully');
    }
      

     public function answer_marked(Request $request,$number)
    {
        $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
          $student_assigned = StudentAssigned::with('assigned_paper')->where('student_id',$this->student->student_id)->findOrFail($number);
          $student_paper = StudentPaper::where(['student_assigned_id'=>$number,'student_id'=>$this->student->student_id,'question_paper_id'=>$student_assigned->assigned_paper->question_paper->id])->first();
           if(!$student_paper){
              $stu_ans =  $student_paper->student_answers()->where(['student_id'=>$this->student->student_id,'sub_question_id'=>$request->question_id,'answer'=>$request->answer])->first();
                    if(!$stu_ans){
                      $student_paper->student_answers()->create(['student_id'=>$this->student->student_id,'sub_question_id'=>$request->question_id,'answer'=>$request->answer]);

                      return respone()->json(['success'=>true]);
                      }
           }
                      return respone()->json(['success'=>false]);
    }





        public function paper_edit($id)
    {

             $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
         $student_assigned = StudentAssigned::with('assigned_paper','class','section')->where('student_id',$this->student->student_id)->findOrFail($id);
            $student_paper = StudentPaper::with('student_assigned_paper','student_answers')->where('student_id',$this->student->student_id)->where('student_assigned_id',$id)->firstOrFail();
         $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($student_assigned->assigned_paper->question_paper->template_id);
         $sections = Section::with('class','section')->where('teacher_id', $student_assigned->teacher_id)->get();
         $paper = Paper::findOrFail($student_assigned->assigned_paper->question_paper->paper_id);

        return view('student.paper.edit',compact('student_assigned','template','paper','sections','student_paper'));
    }


    public function paper_update(Request $request,$number)
    {   
        $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
        $student_paper = StudentPaper::with('student_assigned_paper','student_answers')->where('student_id',$this->student->student_id)->findOrFail($number);
        $student_assigned = StudentAssigned::with('assigned_paper','class','section')->where('student_id',$this->student->student_id)->where('status','saved')->findOrFail($student_paper->student_assigned_id);
        $erros = [];


                      if((!$request->answer)){

                        return back()->withInput($request->input())->with('message','Please choose at least one anwser');
                      }
        
          
          if(!empty($erros)){

            return back()->withInput($request->input())->withErrors($erros);
          }
          
                  foreach ($request->answer as $key => $value) {
                  
                        $stu_ans =  $student_paper->student_answers()->where(['student_id'=>$this->student->student_id,'sub_question_id'=>$key,'answer'=>$value])->first();
                    if(!$stu_ans){
                    $student_paper->student_answers()->create(['student_id'=>$this->student->student_id,'sub_question_id'=>$key,'answer'=>$value]);
                      }
                  }

                  if($request->status){

                    $teacher_id = $student_paper->student_assigned_paper->teacher_id;
        $student_paper->teacher_id  = $teacher_id;
     // dd($student_paper);
        $student_paper->save();
        $s = 0;
        if($student_paper->student_assigned_paper->submit_to > now()){
            $s=1;
        }

        $student_paper->student_assigned_paper()->update(['status'=>'submit','late_tag'=>1,'submit_at'=>date('Y-m-d')]);
           return redirect()->route('student.papers.sent')->with('message','Paper sent to teacher  successfully');
                  }
                      
                  
            
           return redirect()->route('student.papers.saved')->with('message','Paper updated  successfully');
    }

    public function sent_to_teacher($number)
    {
         $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
        $student_paper = StudentPaper::with('student_assigned_paper','student_answers')->where('student_id',$this->student->student_id)->findOrFail($number);
          $erros = [];
           if(!empty($erros)){

            return back()->withInput($request->input())->withErrors($erros);
          }
          
                  // foreach ($request->answer as $key => $value) {
                  
                  //       $stu_ans =  $student_paper->student_answers()->where(['student_id'=>$this->student->student_id,'sub_question_id'=>$key,'answer'=>$value])->first();
                  //   if(!$stu_ans){
                  //   $student_paper->student_answers()->create(['student_id'=>$this->student->student_id,'sub_question_id'=>$key,'answer'=>$value]);
                  //     }
                  // }
        $teacher_id = $student_paper->student_assigned_paper->teacher_id;
        $student_paper->teacher_id  = $teacher_id;
     // dd($student_paper);
        $student_paper->save();
        $s = 0;
        if($student_paper->student_assigned_paper->submit_to > now()){
            $s=1;
        }

        $student_paper->student_assigned_paper()->update(['status'=>'submit','late_tag'=>1]);
           return redirect()->route('student.papers.sent')->with('message','Paper sent to teacher  successfully');

    }

    public function paper_checked(Request $request)
    {
          $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
         $student_assigned = StudentAssigned::with('assigned_paper','class','section','student_paper')->where('student_id',$this->student->student_id)->findOrFail($request->number);
            $student_paper = StudentPaper::with('student_assigned_paper','student_answers')->where('student_id',$this->student->student_id)->where('student_assigned_id',$request->number)->firstOrFail();
         $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($student_assigned->assigned_paper->question_paper->template_id);
         $sections = Section::with('class','section')->where('teacher_id', $student_assigned->teacher_id)->get();
         $paper = Paper::findOrFail($student_assigned->assigned_paper->question_paper->paper_id);
         if($request->isMethod('post')){
                if($student_assigned->question_rechecks->count() >0){

               $student_assigned->status = 'sent';
              $student_assigned->save();
                }
              return redirect()->route('student.papers.sent')->with('message','You cannot submit any question for recheck');
         }

        return view('student.paper.archived',compact('student_assigned','template','paper','sections','student_paper'));
    }

     public function sent_back_paper(Request $request)
    {
          $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
         $student_assigned = StudentAssigned::with('assigned_paper','class','section','question_rechecks')->where('student_id',$this->student->student_id)->findOrFail($request->number);
            $student_paper = StudentPaper::with('student_assigned_paper','student_answers')->where('student_id',$this->student->student_id)->where('student_assigned_id',$request->number)->firstOrFail();
         $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($student_assigned->assigned_paper->question_paper->template_id);
         $sections = Section::with('class','section')->where('teacher_id', $student_assigned->teacher_id)->get();
         $paper = Paper::findOrFail($student_assigned->assigned_paper->question_paper->paper_id);
         if($request->isMethod('post')){
                if($student_assigned->question_rechecks->count() >0){

               $student_assigned->status = 'sent';
              $student_assigned->save();
                }
              return redirect()->route('student.papers.sent')->with('message','You cannot submit any question for recheck');
         }
        return view('student.paper.sent_back_paper',compact('student_assigned','template','paper','sections','student_paper'));
    }

        public function question_recheck(Request $request)
    {
         $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
       $comment = '';
        $question = StudentAnswer::with('sub_question')->where('student_id',$this->student->student_id)->findOrFail($request->id);
;
           $questions_paper = StudentAssigned::where('student_id',$this->student->student_id)->findOrFail($request->number);

           $comment = QuestionRecheck::where(['student_id'=>$this->student->student_id,'student_assigned_id'=>$request->number,'student_answer_id'=>$request->id])->first();
        if($comment){

                        if($request->isMethod('put')){
                         $data = $request->validate([
                              'comment'=>'required',
                         ]);

                         $comment->comment    = $request->comment;
                         $comment->update();

                       return redirect()->back()->with('message','Question Comment updted successfully');
         }
           return view('student.paper.question',compact('question','comment','questions_paper'));
        }



        if($request->isMethod('post')){
          $data = $request->validate([
               'comment'=>'required',
          ]);

          $comment = new QuestionRecheck;
          $comment->student_id = $this->student->student_id;
          $comment->student_assigned_id  = $request->number;
          $comment->teacher_id  = $questions_paper->teacher_id;
          // $comment->question_id   = $question->question_id;
          $comment->student_answer_id    = $request->id;
          $comment->comment    = $request->comment;
          $comment->save();
       
         
        return redirect()->back()->with('message','Question Comment submiited successfully');
         }
        

        return view('student.paper.question',compact('question','comment','questions_paper'));
    }


    public function paper_resubmit(Request $request,$number)
    {   
        $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
        $student_paper = StudentPaper::with('student_assigned_paper','student_answers')->where('student_id',$this->student->student_id)->findOrFail($number);
        // dd($request->all());
        $student_assigned = StudentAssigned::with('assigned_paper','class','section')->where('student_id',$this->student->student_id)->findOrFail($student_paper->student_assigned_id);
                  foreach ($request->answer as $key => $value) {
                  
                        $stu_ans =  $student_paper->student_answers()->where(['student_id'=>$this->student->student_id,'sub_question_id'=>$key,'answer'=>$value])->first();
                    if(!$stu_ans){
                    $student_paper->student_new_answers()->create(['student_id'=>$this->student->student_id,'sub_question_id'=>$key,'answer'=>$value]);
                      }
                  }

                  if($request->status){ $student_paper->save();
        $student_paper->student_assigned_paper()->update(['status'=>'resubmit']);
         return redirect()->route('student.papers.sent')->with('message','Paper sent  successfully');

     }

     //                $teacher_id = $student_paper->student_assigned_paper->teacher_id;
     //    $student_paper->teacher_id  = $teacher_id;
     // // dd($student_paper);
        $student_paper->save();
        $student_paper->student_assigned_paper()->update(['status'=>'sent_saved']);
     //    $s = 0;
     //    if($student_paper->student_assigned_paper->submit_at > now()){
     //        $s=1;
     //    }

     //       return redirect()->route('student.papers.sent')->with('message','Paper sent to teacher  successfully');
     //              }
                      
                  
            
           return redirect()->route('student.papers.draft')->with('message','Paper saved  successfully');
    }

    public function resent_to_teacher(){
            $this->student =  SchoolStudent::with('user')->where('student_id',$this->user->id)->firstOrFail();
        $student_paper = StudentPaper::with('student_assigned_paper','student_answers')->where('student_id',$this->student->student_id)->findOrFail($number);
        $student_paper->save();
        $student_paper->student_assigned_paper()->update(['status'=>'resubmit']);
         return redirect()->route('student.papers.draft')->with('message','Paper saved  successfully');
    }

}
