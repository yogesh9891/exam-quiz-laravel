<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = '';
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.category.index',compact('categories','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = '';
        return view('admin.category.create',compact('category'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

     
        if(!$request->parent_id){
              Category::create(['name'=>$request->name]);
        return redirect()->route('admin.category.index')->with('message','Category are added successfully');

        } else {
            $parent = Category::find($request->parent_id);

            Category::create(['name'=>$request->name,'parent_id'=>$request->parent_id,'level'=>(int)$parent->level+1]);
             return redirect()->route('admin.category.show',$request->parent_id)->with('message','Category are added successfully');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $category = Category::find($id);
        
        
         $categories = Category::where('parent_id',$id)->get();
        return view('admin.category.index',compact('categories','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function create_subcategory($id)
    {
        $category =Category::find($id);
   
          return view('admin.category.create',compact('category'));
    }

    public function update(Request $request, $id)
    {
         $category =Category::find($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        
        $category->update(['name'=>$request->name]);

              return redirect()->back()->with('message','Category are updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category =Category::find($id);
      $category->delete();
        return redirect()->route('admin.category.index')->with('message','Category are delete successfully');
    }
}
