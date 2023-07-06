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

class StudentController extends Controller
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

    public function student_paper(Request $request)
    {

           $this->teacher =  SchoolTeacher::with('user')->where('teacher_id',$this->user->id)->firstOrFail();
       $student_assigned = StudentAssigned::with('teacher','assigned_paper','class','section','student_paper')->where('teacher_id',$this->teacher->teacher_id)->findorFail($request->number);
                $template = Template::with('subject','category','branch','class','twig','leaf','vein','board')->findOrFail($student_assigned->assigned_paper->question_paper->template_id);
         $sections = Section::with('class','section')->where('teacher_id', $student_assigned->teacher_id)->get();
         $paper = Paper::findOrFail($student_assigned->assigned_paper->question_paper->paper_id);

         if($request->isMethod('post')){

            $student_assigned->update(['status'=>'checked']);

              return redirect()->back()->with('message','Question Paper Checked  successfully');
         }

        return view('teacher.paper.sent.student.paper',compact('student_assigned','template','paper','sections'));
    

    }
}
