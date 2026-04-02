<?php

namespace App\Livewire\Admin\Users;

use App\Services\LocationService;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUser extends Component
{
    public $countryId = '';
    public $governorateId = '';
    public $name;
    public $email;
    public $status;
    public $password;
    public $countries = [];
    public $governorates = [];

    public function submit(UserService $userService)
    {
        $data = $this->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'countryId' => ['required', 'integer', 'exists:countaries,id'],
            'governorateId' => ['required', 'integer', 'exists:governorates,id'],
            'password' => ['required', 'min:8'],
            'status' => ['required'],
        ]);

        $user = $userService->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
            'country_id' => $data['countryId'],
            'governorate_id' => $data['governorateId'],
        ]);

        if ($user) {
            $this->reset();
            $this->dispatch('createdUser');
            $this->dispatch('refreshData')->to('side-bar');
            session()->flash('msg', 'User Created Successfuly!');
            $this->dispatch('hideModal');
        }
    }

    public function render(LocationService $locationService)
    {
        $this->countries = $locationService->getAllCountries();
        $this->governorates = $locationService->getGovernoratesByCountryId($this->countryId ?: null)->all();

        return view('livewire.admin.users.create-user', [
            'countries' => $this->countries,
            'governorates' => $this->governorates,
        ]);
    }
}
