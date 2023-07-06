<?php

namespace App\Http\Controllers\Admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Classes;
use App\Models\ClassSection;
use App\Models\School;
use App\Models\Section;
use App\Models\SchoolTeacher;
use App\Models\SchoolStudent;

class SchoolController extends Controller
{
    public $school;

    public function __construct()
    {

       $this->school = User::with('school','classes')->findOrFail(request()->school_id);
    }

    public function classes()
    {
         $classes = Classes::with('class','sections')->where('school_id',$this->school->id)->get();
        return view('reports.school',compact('classes'));
    }

     public function teachers()
    {
          $teachers = SchoolTeacher::with('user','sections')->where('school_id',$this->school->id)->get();
         return view('reports.teacher',compact('teachers'));
    }
      public function students()
    {
           $students = SchoolStudent::with('user','class','section')->where('school_id',$this->school->id)->get();
          return view('reports.students',compact('students'));
    }
}
