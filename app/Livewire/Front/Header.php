<?php

namespace App\Livewire\Front;

use App\Models\Cart;
use App\Models\WatchList;
use Livewire\Component;

class Header extends Component
{
    public $wishlist, $productsCount, $cartCount, $cart;
    protected $listeners = [
        'updateCountWishlist' => 'updateCountWishlist',
        'updateCountWishlistComponent' => 'updateCountWishlistComponent',
        'getNewWishlistProductCount' => 'getNewWishlistProductCount',
        'getCartCount' => 'getCartCount'


    ];

    public function mount()
    {
        if (auth()->check()) {
            $this->updateCountWishlist();
        } else {
            $this->productsCount = 0;
        }
        $this->getCartCount();
        $this->cart = Cart::where('session_id', session()->getId())->with('products')->first();
    }
    public function updateCountWishlist()
    {
        $this->wishlist = WatchList::where('user_id', auth()->user()->id)->with('products')->first();

        if (isset($this->wishlist)) {
            $this->productsCount = count($this->wishlist->products);

        }
        else{
             $this->productsCount = 0;
        }


    }
    public function updateCountWishlistComponent()
    {

        $this->productsCount = count($this->wishlist->products);
    }
    public function getNewWishlistProductCount()
    {
        $this->productsCount = count($this->wishlist->products);
    }
    public function getCartCount()
    {

        $this->cart = Cart::where('session_id', session()->getId())->with('products')->first();
        if (isset($this->cart)) {
            $this->cartCount = count($this->cart->products);
        } else {
            $this->cartCount = 0;
        }
    }

    public function render()
    {
        return view('livewire.front.header');
    }
}
