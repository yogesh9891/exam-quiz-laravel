<?php

namespace App\Http\Livewire\Section;

use Livewire\Component;
use App\Models\ClassSection;

class SiteSection extends Component
{
 
    public $sections,$name;
    public $isOpen = 0;
    public $confirming = null;


    public function render()
    {

        $this->sections = ClassSection::all();
        return view('livewire.section.site-section');
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
        $this->section_id = '';
    }


    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
   
   
        $data = ClassSection::updateOrCreate(['id' => !strlen($this->section_id)? null : $this->section_id], [
            'name' => $this->name,
        ]);


  
        session()->flash('message', 
            $this->section_id ? 'Section Updated Successfully.' : 'Section Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $class = ClassSection::findOrFail($id);
        $this->section_id = $id;
        $this->name = $class->name;
        $this->openModal();
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
        ClassSection::find($id)->delete();
        session()->flash('message', 'Section Deleted Successfully.');
    }
}
