<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('front.users.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {


        $request->authenticate();

        $request->session()->regenerate();
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


        return to_route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        Auth::guard('web')->logout();
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
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('login');
    }
}
