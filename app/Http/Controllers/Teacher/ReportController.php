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

class ReportController extends Controller
{
    public function class()
    {
         $this->teacher =  SchoolTeacher::where('teacher_id',Auth::id())->firstOrFail();
         $teacher =$this->teacher;
          $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');
          $class_array = array_keys($sections->toArray());
         
           return view('teacher.reports.class',compact('class_array'));
    }

   public function student()
    {
        $this->teacher =  SchoolTeacher::where('teacher_id',Auth::id())->firstOrFail();
         $teacher =$this->teacher;
          $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');
          $class_array = array_keys($sections->toArray());
    	  return view('teacher.reports.student',compact('class_array'));
    } 


     public function paper()
    {
             $this->teacher =  SchoolTeacher::where('teacher_id',Auth::id())->firstOrFail();
         $teacher =$this->teacher;
          $sections = Section::where('teacher_id',$this->teacher->teacher_id)->get()->groupBy('class_id');
          $class_array = array_keys($sections->toArray());
        return view('teacher.reports.paper',compact('class_array'));
    	 
    } 
}
