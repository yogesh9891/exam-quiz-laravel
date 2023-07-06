<?php

namespace App\Http\Controllers\Admin\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\School\SaveSchoolRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SchoolClass;
use App\Models\Classes;
use App\Models\ClassSection;
use App\Models\School;
use App\Models\Section;
use App\Models\SchoolGroup;


class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $schools = User::with('school')->whereNotNull('school_id')->get();

       return view('admin.school.index',compact('schools'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $school_groups = SchoolGroup::all();
        $classes = SchoolClass::all();
        $sections = ClassSection::all();
        if($classes->count() <=0 || $classes->count()<=0 ||$sections->count()<=0){
              return redirect()->route('admin.schools.index')->with('message','Please Add School Group or Global Classes or Global Section Before Create School');
        }
         return view('admin.school.create',compact('classes','sections','school_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveSchoolRequest $request)
    {
        // dd($request->all());
        $data = $request->validated(); 
  
        $user = User::create($data);
        $user->assignRole('school');
        $school = School::create(['school_id'=>$user->id,'name'=>$request['school_name'],'region'=>$request['region'],'school_group_id'=>$request['school_group_id']]);
      
           foreach ($request->class_id as  $value) {
                if(!$user->classes()->where('class_id',$value)->first()){
                   $class =   $user->classes()->create(['class_id'=>$value]);
                    if (array_key_exists($value,$request->section_id))
                          {
                                foreach ($request->section_id[$value] as $section) {
                                    if(!$class->sections()->where('section_id',$section)->first()){
                                            $class->sections()->create(['section_id'=>$section]);
                                        }
                                }
                          }
                }
           }
        return redirect()->route('admin.schools.index')->with('message','School is added successfully');
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
    public function edit($id)
    {   
        $user = User::with('school')->find($id);
        $classes = SchoolClass::all();
         $school_groups = SchoolGroup::all();
        $sections = ClassSection::all();
        $school_classes = Classes::with('class','sections')->where('school_id',$id)->get();
   
         return view('admin.school.edit',compact('user','classes','sections','school_classes','school_groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSchoolRequest $request, $id)
    {
       

// dd($request->all());
        $user = User::with('school')->find($id);
        $data = $request->validated();
        $user->update($data);
        $user->school()->update(['name'=>$request['school_name'],'region'=>$request['region'],'school_group_id'=>$request['school_group_id']]);
          return redirect()->route('admin.schools.index')->with('message','School is updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
   
        return redirect()->route('admin.schools.index')->with('message','School is deleted successfully');
    }

    public function get_class(Request $request)
    {
       $classes = $request->classes;
       $sections = $request->sections;

       $html = '  <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2"> Class List</label>';
       foreach ($classes as $key => $class) {

          $html .='   <div class="mt-3 ml-4" >
                      <h5  class="text-primary">Class '.$class['text'].'<input type="hidden" name="class_id[]"  value="'.$class['value'].'"></h5> 
                      <ul class="ml-5">';
                      foreach ($sections as $key => $section) {
                      
                      $html .='<li class="mt-3">'.$class['text'].'-'.$section['text'].'<input type="hidden" name="section_id['.$class['value'].'][]" value="'.$section['value'].'" > <button type="button" class="btn btn-danger btn-sm ml-5 " onclick="removeDiv(this)"><i class="fa fa-times"> </i></button></li>';
                      }
                       
                    $html.=' </ul> <button  type="button" class="btn btn-danger btn-sm my-3 " onclick="removeDiv(this)"><i class="fa
                        fa-trash "> </i> Remove Whole Class</button>
                    </div>';
       }

       return response()->json(['success'=>true,'html'=>$html]);
    }


    public function delete_class_section(Request $request)
    {   
        $school =  User::with('school')->find($request->id);
        if($request->type =='class'){

         $class =    Classes::with('sections')->findOrFail($request->id); 
         $class->sections()->delete();
         $class->delete();
        
        } else{
             $section = Section::findOrFail($request->id); 
             $section->delete();

        }

        return response()->json(['success'=>true]);
    }
}
