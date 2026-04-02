<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAuthRequest;
use App\Http\Requests\AdminResetPasswordRequest;
use App\Http\Requests\VerifyEmailRequest;
use App\Models\Admin;
use App\Notifications\ResetPasswordNotification;
use App\Services\AdminAuthService;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdminAuthController extends Controller
{
    public function __construct(private readonly AdminAuthService $adminAuthService)
    {
    }

    public function index()
    {
        return view('dashboard.auth.login');
    }

    public function recover_password()
    {
        return view('dashboard.auth.recover-password');
    }

    public function login(AdminAuthRequest $request)
    {
        $data = $request->validated();
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
        ]);

        if (!$response->json()['success']) {
            return back()->withErrors(['captcha' => 'ReCAPTCHA validation failed.']);
        }

        $credentials = Auth::guard('admin')->attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ], true);

        if ($credentials) {
            return redirect()->intended('/admin');
        }

        Flasher::addError('Invalid Credentials');

        return to_route('login.get');
    }

    public function post_recover_password(VerifyEmailRequest $request)
    {
        $admin = Admin::where('email', $request->input('email'))->first();

        if ($admin) {
            $admin->generateOTP();
            $admin->notify(new ResetPasswordNotification($admin->otp));

            return redirect()->route('admin.recover-password')->with('msg', 'Verification code sent to your email');
        }
    }

    public function reset_password($token)
    {
        $admin = Admin::where('otp', $token)->first();

        if ($admin) {
            if (now() < $admin->otp_expire_at) {
                return view('dashboard.auth.reset_password', ['token' => $token]);
            }

            return to_route('admin.recover-password')->with('expire-message', ucfirst(' your link is expired please resend again'));
        }

        return to_route('admin.recover-password')->with('invalid-token', ucfirst('Invalid Link'));
    }

    public function update_password(AdminResetPasswordRequest $request)
    {
        if ($this->adminAuthService->updatePassword(
            $request->validated('token'),
            $request->validated('password')
        )) {
            return to_route('login.get');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->intended('/admin/login');
    }
}
