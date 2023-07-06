<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\SaveStudentRequest;
use App\Imports\SchoolStudentImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\SchoolStudent;
use App\Models\SchoolClass;
use App\Models\Classes;
use App\Models\Section;
use App\Models\User;


class StudentController extends Controller
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
        $students = SchoolStudent::with('user','class','section')->where('school_id',$this->school->id)->get();
            $school = $this->school;
              $classes = Classes::with('sections','class')->where('school_id',$this->school->id)->get();
       return view('admin.school.student.index',compact('students','school','classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school = $this->school;


          $classes = Classes::with('sections','class')->where('school_id',$this->school->id)->get();
          
        return view('admin.school.student.create',compact('school','classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveStudentRequest $request)
    {

        $data = $request->validated();
        // dd($data);
        $user = User::create($data);
        $user->assignRole('student');
        $student = new SchoolStudent;
        $student->school_id = $this->school->id;
        $student->admission_id = $request->admission_id;
        $student->roll_no = $request->roll_no;
        $student->class_id = $request->class_id;
        $student->section_id = $request->section_id;
        $student->parent_name = $request->parent_name;
        $student->parent_relation = $request->parent_relation;
        $student->parent_email = $request->parent_email;
        $student->student_id  = $user->id;
        $student->dob  = $request->dob;
        $student->city  = $request->city;
        $student->save();

           return redirect()->route('student.index',$this->school->id)->with('message','Student  is added successfully');
     
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
      public function edit($id,$student_id)
    {
         $user = User::with('student')->findOrFail($student_id);
         $school = $this->school;
         $classes = Classes::with('sections','class')->where('school_id',$this->school->id)->get();
       
         return view('admin.school.student.edit',compact('user','school','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveStudentRequest $request, $id,$student_id)
    {
           $user = User::with('student')->findOrFail($student_id);
                $data = $request->validated();
                $user->update($data);
             $user->student()->update(['admission_id'=>$data['admission_id'],'roll_no'=>$data['roll_no'],'class_id'=>$data['class_id'],'section_id'=>$data['section_id'],'parent_name'=>$data['parent_name'],'parent_email'=>$data['parent_email'],'parent_relation'=>$data['parent_relation'],'dob'=>$request->dob,'city'=>$request->city]);
                    return redirect()->route('student.index',$this->school->id)->with('message','Student  is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$student_id)
    {

           $user = User::find($student_id);
         // $user->student()->delete($id);
         $user->delete();

        return redirect()->route('student.index',$this->school->id)->with('message','School teacher is deleted successfully');
    }

    public function class_section(Request $request)
    {
       $class_id = $request->class_id;
       $sections = Section::with('section')->where('class_id',$class_id)->get();

       $html = '<option selected="">--Select Section--</option>';

        foreach ($sections as  $section) {
            $html.= '<option value="'.$section->id.'">'.$section->section->name.'</option>';
        }

        return response()->json(['success'=>true,'html'=>$html]);
    }


     public function student_import(Request $request) 
    {
       $request->validate([
       'file'=>'required|max:50000|mimes:xlsx,doc,docx,ppt,pptx,ods,odt,odp',
       ]);

       try {
           
        Excel::import(new SchoolStudentImport($request->school_id), $request->file('file')->store('temp'));
       } catch (Exception $e) {
           dd($e);
       }
        return back();
    }

}
