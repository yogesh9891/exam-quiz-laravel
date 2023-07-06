<?php

namespace App\Http\Livewire\SchoolClass;

use Livewire\Component;
use App\Models\SchoolClass;


class GlobalClass extends Component
{
    
    public $classes,$name;
    public $isOpen = 0;
    public $confirming = null;


    public function render()
    {

        $this->classes = SchoolClass::all();
        return view('livewire.school-class.school-class');
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
        $this->class_id = '';
    }


    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
   
   
        $data = SchoolClass::updateOrCreate(['id' => !strlen($this->class_id)? null : $this->class_id], [
            'name' => $this->name,
        ]);


  
        session()->flash('message', 
            $this->class_id ? 'Class Updated Successfully.' : 'Class Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $class = SchoolClass::findOrFail($id);
        $this->class_id = $id;
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
        SchoolClass::find($id)->delete();
        session()->flash('message', 'Class Deleted Successfully.');
    }

}
