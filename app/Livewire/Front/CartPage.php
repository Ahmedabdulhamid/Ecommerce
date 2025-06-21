<?php

namespace App\Livewire\Front;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Component;

class CartPage extends Component
{
    public $cart, $products, $cartCount, $cartProducts, $totalPrice;
    public $quantity = 5;
    protected $listeners = [
        'getProducts' => 'getProducts'
    ];
    public function mount($cart)
    {
        $this->cart = $cart;
        $this->getProducts();
        $this->getTotalPrice();
    }
    public function getProducts()
    {

        $this->products = $this->cart->products ?? [];
    }
    public function incrementQuantity($pivot)
    {
        $productvar = ProductVariant::where('id', $pivot['product_variant_id'])->first();
        $product = Product::where('id', $pivot['product_id'])->first();
        $productCart = CartProduct::where('cart_id', $pivot['cart_id'])->where('product_id', $pivot['product_id'])
            ->where('product_variant_id', $pivot['product_variant_id'])->first();
        if ($product->has_variants) {
            if ($productCart->quantity < $productvar->stock) {
                $productCart->update([
                    'quantity' => $productCart->quantity + 1
                ]);
                $this->getTotalPrice();
            } else {
                $this->dispatch('error');
            }
        }
        if (!$product->has_variants) {
            if ($productCart->quantity < $product->quantity) {
                $productCart->update([
                    'quantity' => $productCart->quantity + 1
                ]);
            } else {
                $this->dispatch('error');
            }
        }
    }

    public function decrementQuantity($pivot)
    {
        $productCart = CartProduct::where('cart_id', $pivot['cart_id'])->where('product_id', $pivot['product_id'])
            ->where('product_variant_id', $pivot['product_variant_id'])->first();
        if ($productCart->quantity > 1) {
            $productCart->update([
                'quantity' => $productCart->quantity - 1
            ]);
            $this->getTotalPrice();
        }
    }
    public function deleteProductFromCart($pivot)
    {
        $productCart = CartProduct::where('cart_id', $pivot['cart_id'])->where('product_id', $pivot['product_id'])
            ->where('product_variant_id', $pivot['product_variant_id'])->first();
        $cartProducts = CartProduct::where('cart_id', $pivot['cart_id'])->get();
        $cart = Cart::where('session_id', session()->getId())->with('products')->first();

        $productCart->delete();
        $this->cartCount = count($cartProducts);
        $this->dispatch('getCartCount')->to('front.header');
        $this->dispatch('success');

        $this->getTotalPrice();
    }
    public function clearCart()
    {
        $cart = Cart::where('session_id', $this->cart['session_id'])->with('products')->first();

        $cart->products()->detach($this->products);
        $this->cartCount = 0;
        $this->dispatch('clearCart');
        $this->dispatch('getCartCount')->to('front.header');

        $this->getTotalPrice();
    }
    public function getTotalPrice()
    {
            if (isset($this->cart)) {
            $cart = Cart::where('session_id', $this->cart['session_id'])->with('products')->first();

        $this->totalPrice = $cart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
        }

    }
    public function render()
    {
        return view('livewire.front.cart-page');
    }
}
