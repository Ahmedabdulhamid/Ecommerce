<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Countary;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

class CreateAccount extends Component
{
    public $countryId = '', $governorateId = '', $name, $phone, $email, $password, $countries = [], $governorates = [], $recaptcha;

#[On('recaptcha')]
public function setRecaptcha($value)
{
   Log::info('reCAPTCHA token received: ' . $value);
    $this->recaptcha = $value;
}

    public function submit()
    {
        $this->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'countryId' => ['required', 'integer', 'exists:countaries,id'],
            'governorateId' => ['required', 'integer', 'exists:governorates,id'],
            'password' => ['required', 'min:8'],
            'phone' => ['required', Rule::unique('users', 'phone')],
            'recaptcha' => ['required'],
        ]);

        if (!$this->verifyRecaptcha($this->recaptcha)) {
            $this->addError('recaptcha', 'فشل التحقق من reCAPTCHA.');
            return;
        }

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'country_id' => $this->countryId,
            'governorate_id' => $this->governorateId,
            'password' => Hash::make($this->password),
            'token' => Str::random(40),
        ]);


        if ($user) {
            $this->reset();
            $user->sendEmailVerificationNotification();
            $this->dispatch('refreshData')->to('side-bar');
            return to_route('login', ['message' => 'Registered Successfully']);
        }
    }

    protected function verifyRecaptcha($token)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $token,
        ]);

        $result = $response->json();
        return $result['success'] ?? false;
    }

    public function render()
    {
        $this->countries = Countary::all();
        $this->governorates = $this->countryId
            ? Governorate::where('countary_id', $this->countryId)->get()
            : [];

        return view('livewire.create-account', [
            'countries' => $this->countries,
            'governorates' => $this->governorates,
        ]);
    }
}
