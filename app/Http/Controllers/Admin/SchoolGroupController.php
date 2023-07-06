<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolGroup;

class SchoolGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $school_groups = SchoolGroup::all();
       return view('admin.school_group.index',compact('school_groups'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.school_group.create');
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
            'name'=>'required|string|max:255',
        ]);
        SchoolGroup::create($data);
         return redirect()->route('admin.school_group.index')->with('message','School Group are added successfully');
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
    public function edit(SchoolGroup $school_group)
    {
         return view('admin.school_group.edit',compact('school_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolGroup $school_group)
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
        ]);
        $school_group->update($data);
         return redirect()->route('admin.school_group.index')->with('message','School Group are updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolGroup $school_group)
    {
        $school_group->delete();
         return redirect()->route('admin.school_group.index')->with('message','School Group are deleted successfully');
    }
}
