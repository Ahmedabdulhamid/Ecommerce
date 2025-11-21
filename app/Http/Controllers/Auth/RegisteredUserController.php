<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use App\Notifications\SendCouponNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('front.users.register');
    }
    public function googleAuth()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirect()
    {
        $sosialiteUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate([
            'provider_id' => $sosialiteUser->getId(),
        ], [
            'name' => $sosialiteUser->getName(),
            'email' => $sosialiteUser->getEmail(),
            'phone' => null,
            'email_verified_at' => now(),
            'password' => Hash::make(Str::random(24)),
        ]);

        Auth::login($user);
        if (is_null($user->last_login_at)) {
            // أول مرة
            $coupon = Coupon::create([
                'code' => strtoupper(Str::random(10)), // كود عشوائي
                'discount_precentage' => 15,
                'start_at' => now(),
                'end_at' => now()->addDays(7),
                'limit' => 1,
                'time_used' => 0,
                'status' => 'active',

            ]);
            $user->notify(new SendCouponNotification($coupon));
        }

        $user->last_login_at = now();
        $user->save();
        // 💡 استرجاع cart_id من الجلسة
        $cart_id = session()->get('cart_id');

        if ($cart_id) {
            $cart = Cart::find($cart_id);

            if ($cart && is_null($cart->user_id)) {
                $cart->update([
                    'user_id' => auth()->id(),
                    'session_id' => session()->getId()
                ]);
            }
        }
        $orderNumber = session('current_order_number');

        if ($orderNumber) {
            $order = Order::where('order_number', $orderNumber)->first();
            if ($order) {
                $order->update(['user_id' => auth()->id()]);
            }
        }


        return redirect()->route('home');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));



        return redirect(RouteServiceProvider::HOME);
    }
}
