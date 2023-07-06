<?php

namespace App\Http\Controllers\Admin\Paper;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paper\SavePaper2Request;
use Illuminate\Http\Request;
use App\Models\Paper;
use App\Models\Template;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $papers = Paper::all();
        return view('admin.template.paper.index',compact('papers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       $templates = Template::all();
           return view('admin.template.paper.create',compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SavePaper2Request $request)
    {

        $data = $request->validated();
        // dd($data);
        Paper::create($data);
       return redirect()->route('paper.index')->with('message','Paper Top created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $templates = Template::all();
           $paper = Paper::find($id);
           return view('admin.template.paper.show',compact('templates','paper'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           $templates = Template::all();
           $paper = Paper::find($id);
           return view('admin.template.paper.edit',compact('templates','paper'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SavePaper2Request $request, $id)
    {
             $data = $request->validated();
        // dd($data);
        Paper::find($id)->update($data);
       return redirect()->route('paper.index')->with('message','Paper Top updatesd successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Paper::find($id)->delete();
       return redirect()->route('paper.index')->with('message','Paper Top deleted successfully');
    }
}
