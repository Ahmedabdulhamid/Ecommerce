<?php

namespace App\Livewire\Front;

use App\Models\Countary;
use App\Models\Governorate;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalInfo extends Component
{
  public $countries, $governorates,$countryId,$governorateId,$name,$email,$phone;
  public function submit()
  {
    $data=$this->validate([
      'countryId'=>['required','exists:countaries,id','integer'],
      'governorateId'=>['required','exists:governorates,id','integer'],
      'name'=>['required','max:255'],
      'email'=>['required','email'],
      'phone' => ['required', 'string', 'min:10', 'max:15']

    ]);
    $user=Auth::user();
     $data['country_id']=$this->countryId;
     $data['governorate_id']=$this->governorateId;
    $user->update($data);
    $this->dispatch('UpdateUserInfo');

  }


  public function mount()
  {
    $this->countries = Countary::whereStatus('active')->get();
  }
    public function render()
{
    $country = \App\Models\Countary::whereId($this->countryId)->first();

    if ($country) {
        $this->governorates = \App\Models\Governorate::where('countary_id', $this->countryId)->get();
    } else {
        $this->governorates = [];
    }

    return view('livewire.front.personal-info', [
        'countries' => $this->countries,
        'governorates' => $this->governorates
    ]);
}

}
