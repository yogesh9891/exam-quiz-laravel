<?php

namespace App\Http\Livewire\Board;

use Livewire\Component;
use App\Models\Board;

class Boards extends Component
{
    public $boards,$name,$is_state,$board_id;
    public $isOpen = 0;
    public $confirming = null;


    public function render()
    {
        $this->boards = Board::where('is_board',1)->get();
        return view('livewire.board.boards');
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
        $this->board_id = '';
    }


    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
   
   
        $data = Board::updateOrCreate(['id' => !strlen($this->board_id)? null : $this->board_id], [
            'name' => $this->name,
            'is_state' => $this->is_state,
        ]);


  
        session()->flash('message', 
            $this->board_id ? 'Board Updated Successfully.' : 'Board Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $class = Board::findOrFail($id);
        $this->board_id = $id;
        $this->name = $class->name;
        $this->is_state = $class->is_state;
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
            Board::find($id)->delete();
            session()->flash('message', 'Board Deleted Successfully.');
        }


}
