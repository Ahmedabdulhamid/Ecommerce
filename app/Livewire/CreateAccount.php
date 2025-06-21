<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Countary;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class CreateAccount extends Component
{

    public $countryId = '', $governorateId = '',$name,$phone,$email,$password, $countries = [], $governorates = [];
    public function submit(){

        $data= $this->validate([
            'name'=>['required','string'],
            'email'=>['required','email','unique:users'],
            'countryId'=>['required','integer','exists:countaries,id'],
            'governorateId'=>['required','integer','exists:governorates,id'],
            'password'=>['required','min:8'],
          'phone' => [
                'required',

                Rule::unique('users', 'phone'),
            ],
        ]);

        $data['password']=Hash::make($this->password);
        $data['country_id']=$this->countryId;
        $data['governorate_id']=$this->governorateId;
        $data['token']=str::random(40);

        $user=User::create($data);

        if ($user) {
            $this->reset();

            $this->dispatch('refreshData')->to('side-bar');
            $user->sendEmailVerificationNotification();
            return to_route('login',['message'=>'Registered Successfully']);

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
        return view('livewire.create-account',['countries' => $this->countries, 'governorates' => $this->governorates]);
    }
}
