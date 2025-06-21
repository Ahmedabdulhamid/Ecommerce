<?php

namespace App\Livewire\Front;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component
{


public $current_password, $new_password, $new_password_confirmation;

public function submit()
{
    $this->validate([
        'current_password' => ['required'],
        'new_password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = Auth::user();

    if (!Hash::check($this->current_password, $user->password)) {
        // إضافة خطأ بشكل صحيح في Livewire
        $this->addError('current_password', 'كلمة المرور الحالية غير صحيحة.');
        return;
    }

    $user->password = Hash::make($this->new_password);
    $user->save();

    // ممكن ترجع رسالة نجاح أو تعمل reset للحقول
    $this->dispatch('passwordChanged');
    $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
}

    public function render()
    {
        return view('livewire.front.change-password');
    }
}
