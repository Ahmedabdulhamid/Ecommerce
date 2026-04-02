<?php

namespace App\Livewire;

use App\Services\LocationService;
use App\Services\UserService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateAccount extends Component
{
    public $countryId = '';
    public $governorateId = '';
    public $name;
    public $phone;
    public $email;
    public $password;
    public $countries = [];
    public $governorates = [];
    public $recaptcha;

    #[On('recaptcha')]
    public function setRecaptcha($value)
    {
        Log::info('reCAPTCHA token received: ' . $value);
        $this->recaptcha = $value;
    }

    public function submit(UserService $userService)
    {
        $data = $this->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'countryId' => ['required', 'integer', 'exists:countaries,id'],
            'governorateId' => ['required', 'integer', 'exists:governorates,id'],
            'password' => ['required', 'min:8'],
            'phone' => ['required', Rule::unique('users', 'phone')],
            'recaptcha' => ['required'],
        ]);

        if (!$this->verifyRecaptcha($data['recaptcha'])) {
            $this->addError('recaptcha', 'فشل التحقق من reCAPTCHA.');

            return;
        }

        $user = $userService->register([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => $data['password'],
            'country_id' => $data['countryId'],
            'governorate_id' => $data['governorateId'],
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

    public function render(LocationService $locationService)
    {
        $this->countries = $locationService->getAllCountries();
        $this->governorates = $locationService->getGovernoratesByCountryId($this->countryId ?: null)->all();

        return view('livewire.create-account', [
            'countries' => $this->countries,
            'governorates' => $this->governorates,
        ]);
    }
}
