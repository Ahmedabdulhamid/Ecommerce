<?php

namespace App\Livewire\Front;

use App\Models\Cart;
use App\Models\CartProduct;
use Livewire\Component;

class CartPage extends Component
{
    public $cart = null;
    public float $totalPrice = 0;

    protected $listeners = ['getCartItem' => 'getCartItem'];

    public function mount($cart = null): void
    {
        if ($cart) {
            $this->cart = $cart;
        }
        $this->getCartItem();
    }

    public function getCartItem(): void
    {
        $cart = $this->getCurrentCart();

        $this->cart = $cart;
        $this->totalPrice = 0;

        if (!$cart) {
            return;
        }

        $this->totalPrice = (float) $cart->products->sum(function ($product) {
            return ((float) $product->pivot->price) * ((int) $product->pivot->quantity);
        });
    }

    protected function getCurrentCart(): ?Cart
    {
        $userId = auth()->guard('web')->id();
        $sessionId = session()->getId();

        return Cart::query()
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }, function ($query) use ($sessionId) {
                $query->where('session_id', $sessionId);
            })
            ->with(['products.images'])
            ->first();
    }

    public function decrementQuantity(?int $cartProductId = null): void
    {
        if (!$cartProductId) {
            return;
        }

        $cart = $this->getCurrentCart();
        if (!$cart) {
            return;
        }

        $cartItem = CartProduct::where('cart_id', $cart->id)
            ->where('id', $cartProductId)
            ->first();

        if (!$cartItem) {
            return;
        }

        if ((int) $cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }

        $this->dispatch('getCartCount')->to('front.header');
        $this->getCartItem();
    }

    public function incrementQuantity(?int $cartProductId = null): void
    {
        if (!$cartProductId) {
            return;
        }

        $cart = $this->getCurrentCart();
        if (!$cart) {
            return;
        }

        $cartItem = CartProduct::where('cart_id', $cart->id)
            ->where('id', $cartProductId)
            ->with(['product', 'productVariant'])
            ->first();

        if (!$cartItem) {
            return;
        }

        $maxStock = $cartItem->product_variant_id
            ? (int) optional($cartItem->productVariant)->stock
            : (int) optional($cartItem->product)->quantity;

        if ($maxStock > 0 && (int) $cartItem->quantity >= $maxStock) {
            $this->dispatch('error');
            return;
        }

        $cartItem->increment('quantity');
        $this->dispatch('getCartCount')->to('front.header');
        $this->getCartItem();
    }

    public function deleteProductFromCart(?int $cartProductId = null): void
    {
        if (!$cartProductId) {
            return;
        }

        $cart = $this->getCurrentCart();
        if (!$cart) {
            return;
        }

        CartProduct::where('cart_id', $cart->id)
            ->where('id', $cartProductId)
            ->delete();

        $this->dispatch('success');
        $this->dispatch('getCartCount')->to('front.header');
        $this->getCartItem();
    }

    public function clearCart(): void
    {
        $cart = $this->getCurrentCart();
        if (!$cart) {
            return;
        }

        $cart->products()->detach();
        $this->dispatch('success');
        $this->dispatch('getCartCount')->to('front.header');
        $this->getCartItem();
    }

    public function render()
    {
        return view('livewire.front.cart-page');
    }
}
