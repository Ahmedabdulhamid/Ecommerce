<?php

namespace App\Livewire\Front;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function submit(UserService $userService)
    {
        $this->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'كلمة المرور الحالية غير صحيحة.');

            return;
        }

        $userService->updatePassword($user->id, $this->new_password);

        $this->dispatch('passwordChanged');
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
    }

    public function render()
    {
        return view('livewire.front.change-password');
    }
}
