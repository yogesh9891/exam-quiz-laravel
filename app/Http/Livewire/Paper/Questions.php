<?php

namespace App\Http\Livewire\Paper;

use Livewire\Component;
use App\Models\Question;

class Questions extends Component
{

    public $questions,$question;
    public $isOpen = 0;
    public $confirming = null;
    public $status = 'create';

    public function render()
    {

        $this->questions = Question::all();
        return view('livewire.paper.questions');
    }
    public function create()
    {
       return redirect()->route('questions');
       
    }
    

  
    
    public function back()
    {
        $this->status = 'index';
    }


    private function resetInputFields(){
        $this->question = '';
        $this->question_id = '';
    }


    public function store()
    {
        $this->validate([
            'question' => ['required'],
        ]);
   
   
        $data = Question::updateOrCreate(['id' => !strlen($this->question_id)? null : $this->question], [
            'question' => $this->question,
        ]);


  
        session()->flash('message', 
            $this->section_id ? 'Question Updated Successfully.' : 'Question Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $class = Question::findOrFail($id);
        $this->question_id = $id;
        $this->question = $class->question;
         $this->updateMode = true;
      
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
        Question::find($id)->delete();
        session()->flash('message', 'Question Deleted Successfully.');
    }
}
