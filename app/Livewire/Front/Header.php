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

        $this->loadCart();
    }

    public function updateCountWishlist()
    {
        $this->wishlist = WatchList::query()
            ->where('user_id', auth()->id())
            ->withCount('products')
            ->first();

        $this->productsCount = $this->wishlist?->products_count ?? 0;
    }

    public function updateCountWishlistComponent()
    {
        $this->productsCount = $this->wishlist?->products_count ?? $this->productsCount;
    }

    public function getNewWishlistProductCount()
    {
        $this->updateCountWishlist();
    }

    public function getCartCount()
    {
        $this->loadCart();
    }

    protected function loadCart(): void
    {
        $this->cart = Cart::query()
            ->where('session_id', session()->getId())
            ->with(['products.images'])
            ->first();

        $this->cartCount = $this->cart?->products->count() ?? 0;
    }

    public function render()
    {
        return view('livewire.front.header');
    }
}
