<?php

namespace App\Livewire\Admin\Users;

use App\Models\Countary;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component

{
    public $countryId = '', $governorateId = '',$name,$email,$status,$password, $countries = [], $governorates = [];
    public function submit(){
       $data= $this->validate([
            'name'=>['required','string'],
            'email'=>['required','email','unique:users'],
            'countryId'=>['required','integer','exists:countaries,id'],
            'governorateId'=>['required','integer','exists:governorates,id'],
            'password'=>['required','min:8'],
            'status'=>['required']
        ]);
        $data['password']=Hash::make($this->password);
        $data['country_id']=$this->countryId;
        $data['governorate_id']=$this->governorateId;
        $user=User::create($data);
        if ($user) {
            $this->reset();
            $this->dispatch('createdUser');
            $this->dispatch('refreshData')->to('side-bar');
            session()->flash('msg','User Created Successfuly!');
            $this->dispatch('hideModal');
        }


    }
    public function render()
    {
        $this->countries = Countary::all();
        $country = Countary::where('id', $this->countryId)->first();
        if ($country) {
            $this->governorates = Governorate::where('countary_id', $country->id)->get();
        } else {
            $this->governorates = [];
        }

        return view('livewire.admin.users.create-user', ['countries' => $this->countries, 'governorates' => $this->governorates]);
    }
}
