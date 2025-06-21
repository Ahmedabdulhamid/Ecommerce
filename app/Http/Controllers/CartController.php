<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['products.images','products.product_variants'])->where('session_id', session()->getId())->first();
        return view('front.cart.cart',['cart'=>$cart]);
    }
}
