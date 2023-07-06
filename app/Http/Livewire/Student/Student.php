<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\User;
use App\Models\SchoolStudent;
use Spatie\Permission\Models\Role;
use Hash;

class Student extends Component
{
    public $users,$name, $email,$password,$password_confirmation,$phone,$role,$roles,$school_id;
    public $is_active = 0;
    public $isOpen = 0;
    public $updateMode = false;
    public $confirming = null;


      public function mount($id)
    {
        $this->school_id = $id;
    }



    public function render()
    {

        $d =  SchoolStudent::select('student_id')->where('school_id',$this->school_id)->get()->toArray(); 
        $this->users = User::wherein('id',$d)->get();

        $this->roles = Role::all()->pluck('name');
        return view('livewire.student.student');
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
        $this->email = '';
        $this->phone = '';
        $this->user_id = '';
        $this->role = '';
    }


    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
   
        $data = User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
        ]);

        $data->assignRole('school');

  
        session()->flash('message', 
            $this->user_id ? 'student Updated Successfully.' : 'student Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required'],
        ]);


        $data = User::find($this->user_id);
        $data->name = $this->name;
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
            $this->user_id ? 'student Updated Successfully.' : 'student Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }



    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
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
        session()->flash('message', 'student Deleted Successfully.');
    }
}
