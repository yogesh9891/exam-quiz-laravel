<?php

namespace App\Http\Livewire\Subject;

use Livewire\Component;
use App\Models\Subject;

class Subjects extends Component
{
    public $subjects,$name;
    public $isOpen = 0;
    public $confirming = null;


    public function render()
    {

        $this->subjects = Subject::all();
        return view('livewire.subject.subject');
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
        $this->subject_id = '';
    }


    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
   
   
        $data = Subject::updateOrCreate(['id' => !strlen($this->subject_id)? null : $this->subject_id], [
            'name' => $this->name,
        ]);


  
        session()->flash('message', 
            $this->subject_id ? 'Subject Updated Successfully.' : 'Subject Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $class = Subject::findOrFail($id);
        $this->subject_id = $id;
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
        Subject::find($id)->delete();
        session()->flash('message', 'Subject Deleted Successfully.');
    }


}
