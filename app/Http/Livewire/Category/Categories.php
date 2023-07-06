<?php

namespace App\Http\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class Categories extends Component
{

    public $categories,$name,$parent_id,$parent_category,$category_list;
    public $isOpen = 0;
    public $confirming = null;
    public $category_id = null;


    public function mount()
    {
        // code...
        $this->categories = Category::where('parent_id',null)->get();
        $this->category_list = Category::where('parent_id',null)->get();
    }

    public function render()
    {
        if($this->parent_id){
            $id = $this->parent_id;
               $this->parent_category = Category::with('parentCategory')->findOrFail($id);
             $this->categories  = Category::where('parent_id',$id)->get();
        } else{
            $this->categories = Category::where('parent_id',null)->get();
        $this->category_list = Category::where('parent_id',null)->get();
        }

        return view('livewire.category.categories');
    }




    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    

    public function openModal()
    {
        $this->isOpen = true;
    }
    
    public function closeModal()
    {
        $this->isOpen = false;
    }


    private function resetInputFields(){
            $this->name = '';
            $this->category_id = '';
            // $this->parent_id = '';
    }


    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        
        
        $data = Category::updateOrCreate(['id' => $this->category_id], [
            'name' => $this->name,
            'parent_id' => !strlen($this->parent_id)?null:$this->parent_id ,
        ]);


        session()->flash('message', 
            $this->category_id ? 'Section Updated Successfully.' : 'Section Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;
        $this->parent_id = $this->parent_id?$this->parent_id:$category->parent_id;
        $this->openModal();
    }

     public function show($id)
    {
        $this->parent_id = $id;
        $this->parent_category = Category::with('parentCategory')->findOrFail($id);
       $this->categories  = Category::where('parent_id',$id)->get();
    }




    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }  


    public function cancelDlt()
    {
        $this->confirming = null;
    }


    public function delete($id)
    {
        Category::find($id)->delete();
        session()->flash('message', 'Section Deleted Successfully.');
    }
}
