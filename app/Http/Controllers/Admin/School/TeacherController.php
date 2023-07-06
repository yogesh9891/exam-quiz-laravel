<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\School\SaveSchoolTeacher;
use App\Models\School;
use App\Models\SchoolTeacher;
use App\Models\User;
use App\Models\TeacherAssign;

use App\Imports\SchoolTeacherImport;
use Maatwebsite\Excel\Facades\Excel;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $school;

    public function __construct()
    {
       $this->school = User::with('school')->findOrFail(request()->school_id);
    }

    public function index()
    {
         $teachers = SchoolTeacher::with('user')->where('school_id',$this->school->id)->get();
            $school = $this->school;
       return view('admin.school.teacher.index',compact('teachers','school'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $school = $this->school;
         return view('admin.school.teacher.create',compact('school'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveSchoolTeacher $request)
    {
             $data = $request->validated(); 
  
        $user = User::create($data);
        $user->assignRole('teacher');
        $user->teacher()->create(['school_id'=>$this->school->id]);
        
         return redirect()->route('teachers.index',$this->school->id)->with('message','School teacher  is added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$teacher_id)
    {
         $user = User::with('teacher')->find($teacher_id);
         $school = $this->school;
       
         return view('admin.school.teacher.edit',compact('user','school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSchoolTeacher $request, $id,$teacher_id)
    {
        $user = User::find($teacher_id);
        $data = $request->validated();
        $user->update($data);
          return redirect()->route('teachers.index',$this->school->id)->with('message','School teacher is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$teacher_id)
    {
       $user = User::find($teacher_id);
         // $user->teacher()->delete();
         $user->delete();

        return redirect()->route('teachers.index',$this->school->id)->with('message','School teacher is deleted successfully');
    }

       public function teacher_import(Request $request) 
    {
       $request->validate([
       'file'=>'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp',
       ]);
        Excel::import(new SchoolTeacherImport($request->school_id), $request->file('file')->store('temp'));
        return back();
    }

    public function teacher_class(Request $request)
    {   

          $teachers = TeacherAssign::where('school_id',$this->school->id)->get();
        if($request->class && $request->teacher){
             $teachers = SchoolTeacher::with('user')->where('school_id',$this->school->id)->get();
          $teacher_assign= TeacherAssign::where('school_id',$this->school->id)->where('teacher_id',$request->teacher)->where('class_id',$request->class)->whereStatus(1)->get();
          dd($teachers);
        }

         return view('admin.school.teacher.class',compact('teachers'));

    }

}
