<?php

namespace App\Services;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthService
{
    public function updatePassword(string $token, string $password): bool
    {
        $admin = Admin::where('otp', $token)->firstOrFail();

        return $admin->update([
            'password' => Hash::make($password),
        ]);
    }
}
