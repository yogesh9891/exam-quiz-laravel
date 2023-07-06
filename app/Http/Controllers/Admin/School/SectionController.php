<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolClass;
use App\Models\Classes;
use App\Models\User;
use App\Models\ClassSection;
use App\Models\Section;
use App\Models\SchoolStudent;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

        public $class;

    public function __construct()
    {
       $this->class =   Classes::with('school','sections','class')->findOrFail(request()->class_id);
    }
    public function index()
    {
          $sections = Section::with('class','section','teacher')->withCount('section_student')->where('class_id',$this->class->id)->get();
     

            $class = $this->class;
            
       return view('admin.school.section.index',compact('sections','class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $class = $this->class;
                  $sections = Section::select('section_id')->where('class_id',$this->class->id)->get()->toArray();
                  $class_sections =[];
                  foreach($sections as $elem) { $class_sections[] = array_shift($elem); }
                 
         $all_sections = ClassSection::whereStatus(1)->get();
         return view('admin.school.section.create',compact('class','all_sections','class_sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'section'=>'required|array',
        ]);
           foreach ($request->section as  $value) {
                if(!$this->class->sections()->where('section_id',$value)->first()){
                    $this->class->sections()->create(['section_id'=>$value]);
                }
           }

                 return redirect()->route('section.index',$this->class->id)->with('message','School Classes are updated successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($class_id,$section_id)
    {

         $section = Section::with('section')->where('section_id',$section_id)->where('class_id',$this->class->id)->first();
   
        $students = SchoolStudent::with('user')->where('section_id',$section->id)->get();

        
            $class = $this->class;
        return view('admin.school.section.student',compact('students','class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$section_id)
    {
          $this->class->sections()->where('section_id',$section_id)->delete();

        return redirect()->route('section.index',$this->class->id)->with('message','Classes Section are removed successfully');
    }
}
