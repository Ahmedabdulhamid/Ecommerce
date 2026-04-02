<?php

namespace App\Livewire\Admin;

use App\Services\AdminService;
use Livewire\Component;

class CreateAdmin extends Component
{
    public $name;
    public $email;
    public $password;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:admins,email'],
            'password' => ['required', 'min:8', 'max:20'],
        ];
    }

    public function submit(AdminService $adminService)
    {
        $admin = $adminService->create($this->validate());

        if ($admin) {
            $this->dispatch('AdminCreatedSuccessfully');
            $this->dispatch('refreshAdmins')->to('side-bar');
        }
    }

    public function render()
    {
        return view('livewire.admin.create-admin');
    }
}
