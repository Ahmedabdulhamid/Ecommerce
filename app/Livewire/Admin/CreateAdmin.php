<?php

namespace App\Livewire\Admin;

use App\Models\Admin;
use Hash;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Livewire\Component;

class CreateAdmin extends Component
{
    public $name,$email,$password;
    public function rules() :array{
        return [
            'name'=>['required','string','max:255'],

            'email'=>['required','email','unique:admins,email'],

             'password'=>['required','min:8','max:20'],

        ];
    }
    public function submit(){

     $data= $this->validate();
     $data['password']=FacadesHash::make($this->password);
     $admin=Admin::create($data);
     if ($admin) {
        $this->dispatch('AdminCreatedSuccessfully');

        $this->dispatch("refreshAdmins")->to('side-bar');

     }
    }
    public function render()
    {
        return view('livewire.admin.create-admin');
    }
}
