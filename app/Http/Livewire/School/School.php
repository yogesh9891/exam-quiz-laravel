<?php

namespace App\Http\Livewire\School;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;

class School extends Component
{
    
    public $users,$name, $email,$password,$password_confirmation,$phone,$role,$roles,$school_id;
    public $is_active = 0;
    public $isOpen = 0;
    public $updateMode = false;
    public $confirming = null;


    public function render()
    {

        $this->users =  User::role('school')->get(); 

        $this->roles = Role::all()->pluck('name');
        return view('livewire.school.school');
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
        $this->school_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->user_id = '';
        $this->role = '';
    }


    public function store()
    {
        $this->validate([
            'school_id' => ['required', 'string', 'max:255','unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
   
        $data = User::updateOrCreate(['id' => $this->user_id], [
            'school_id' => $this->school_id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
        ]);

        $data->assignRole('school');

  
        session()->flash('message', 
            $this->user_id ? 'School Updated Successfully.' : 'School Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'school_id' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required'],
        ]);


        $data = User::find($this->user_id);
        $data->name = $this->name;
        $data->school_id = $this->school_id;
        $data->email = $this->email;
        $data->phone = $this->phone;
        if($this->password && $this->password == $this->password_confirmation){
            
            $data->password = Hash::make($this->password);

        }

        $data->update();

   
        // $data = User::updateOrCreate(['id' => $this->user_id], [
        //     'name' => $this->name,
        //     'email' => $this->email,
        //     'phone' => $this->phone,
        //     'password' => Hash::make($this->password),
        // ]);

        // $data->assignRole($this->role);

  
        session()->flash('message', 
            $this->user_id ? 'School Updated Successfully.' : 'School Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->school_id = $user->school_id;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->role = $user->roles[0]->name;
        $this->updateMode = true;
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
        User::find($id)->delete();
        session()->flash('message', 'School Deleted Successfully.');
    }
}
