<?php

namespace App\Livewire\Front;

use App\Services\LocationService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PersonalInfo extends Component
{
    public $countries;
    public $governorates;
    public $countryId;
    public $governorateId;
    public $name;
    public $email;
    public $phone;

    public function submit(UserService $userService)
    {
        $data = $this->validate([
            'countryId' => ['required', 'exists:countaries,id', 'integer'],
            'governorateId' => ['required', 'exists:governorates,id', 'integer'],
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'string', 'min:10', 'max:15'],
        ]);

        $userService->updateProfile(Auth::id(), [
            'country_id' => $data['countryId'],
            'governorate_id' => $data['governorateId'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
        ]);

        $this->dispatch('UpdateUserInfo');
    }

    public function mount(LocationService $locationService)
    {
        $this->countries = $locationService->getActiveCountries();
    }

    public function render(LocationService $locationService)
    {
        $this->governorates = $locationService->getGovernoratesByCountryId($this->countryId ?: null);

        return view('livewire.front.personal-info', [
            'countries' => $this->countries,
            'governorates' => $this->governorates,
        ]);
    }
}
