<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\Classes;
use App\Models\User;
use App\Models\Section;
use App\Models\SchoolTeacher;


class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
      public $school;

    public function __construct()
    {
       $this->school = User::with('school','classes')->findOrFail(request()->school_id);
    }

    public function index()
    {
         $classes = Classes::with('class')->where('school_id',$this->school->id)->get();

            $school = $this->school;
       return view('admin.school.class.index',compact('classes','school'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         $school = $this->school;
                  $classes = Classes::select('class_id')->where('school_id',$this->school->id)->get()->toArray();
                  $school_classes =[];
                  foreach($classes as $elem) { $school_classes[] = array_shift($elem); }
                 
         $all_classes = SchoolClass::whereStatus(1)->get();
         return view('admin.school.class.create',compact('school','all_classes','school_classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
           foreach ($request->class as  $value) {
                if(!$this->school->classes()->where('class_id',$value)->first()){
                    $this->school->classes()->create(['class_id'=>$value]);
                }
           }

                 return redirect()->route('class.index',$this->school->id)->with('message','School Classes are updated successfully');

    }

   
    public function destroy($school_id,$class_id)
    {
      
         $this->school->classes()->where('id',$class_id)->delete();

        return redirect()->route('class.index',$this->school->id)->with('message','School Classes are removed successfully');
    }



    public function edit($school_id,$class_id)
    {
       $school = $this->school;
             
                 
         $school_teachers =  SchoolTeacher::with('user')->where('school_id',$school->id)->get();
         $sections = Section::with('section','teacher')->where('class_id',$class_id)->get();
         $class = Classes::with('class')->where('id',$class_id)->firstOrFail();
         return view('admin.school.class.teacher',compact('school','school_teachers','sections','class'));
    }


    public function update(Request $request)
    {

        $data = $request->validate([
       'section'=>'required|array',
       'teacher_id'=>'required',
        ],['teacher_id.required'=>'Please Select Teacher']);

       
      $sections = $request->section;
      if($sections){
        foreach ($sections as $section) {
           $sec = Section::find($section);
           // dd($sec);
           if($sec){
            $sec->teacher_id = $request->teacher_id;
            $sec->update();
           }

        }
      }

              return redirect()->route('class.index',$this->school->id)->with('message','School Classes  teacher assigned successfully');
    }



    
}
