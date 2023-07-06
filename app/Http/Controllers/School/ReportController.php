<?php

namespace App\Http\Controllers\School;

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
use App\Models\Classes;
use Auth;
class ReportController extends Controller
{
   public function class()
    {
         $user =  User::findOrFail(Auth::id());
         $classes =  Classes::where('school_id',$user->id)->get()->groupBy('id');
        // dd(array_keys($classes));

          $class_array =array_keys($classes->toArray(),true);
      
           return view('teacher.reports.class',compact('class_array'));
    }

   public function student()
    {
         $user =  User::findOrFail(Auth::id());
         $classes =  Classes::where('school_id',$user->id)->get()->groupBy('id');
        // dd(array_keys($classes));

          $class_array =array_keys($classes->toArray(),true);
    	  return view('teacher.reports.student',compact('class_array'));
    } 


     public function paper()
    {
         $user =  User::findOrFail(Auth::id());
         $classes =  Classes::where('school_id',$user->id)->get()->groupBy('id');
        // dd(array_keys($classes));

          $class_array =array_keys($classes->toArray(),true);
        return view('teacher.reports.paper',compact('class_array'));
    	 
    } 
}
