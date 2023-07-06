<?php

namespace App\Http\Livewire\Role;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserRole extends Component
{

    public $users,$name,$role,$roles,$role_id;
    public $is_active = 0;
    public $isOpen = 0;
    public $updateMode = false;

    public function render()
    {
        $this->roles = Role::all();


        return view('livewire.role.user-role');
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
        $this->updateMode = false;
    }



    private function resetInputFields(){
        $this->name = '';
        $this->role = '';
    }


    public function edit($id)
    {
        $user = Role::findOrFail($id);
        $this->role_id = $id;
        $this->name = $user->name;
        $this->updateMode = true;
        $this->openModal();
    }



    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
   
        $data = Role::updateOrCreate(['id' => $this->role_id], [
            'name' => $this->name,
        ]);

  
        session()->flash('message', 
            $this->role_id ? 'Role Updated Successfully.' : 'Role Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



}
