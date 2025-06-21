<?php

namespace App\Livewire\Front;

use App\Models\Product;
use Illuminate\Support\Facades\Process;
use Livewire\Component;
use App\Models\WatchList as WatchListModal;

class Watchlist extends Component
{
    public $products = [];
    public $watchlist;
   public $productCount;
    protected $listeners = ['getProducts' => 'getProducts'];

    public function mount()
    {
        $this->getProducts();
    }

    public function getProducts()
    {
        $this->watchlist = WatchListModal::with('products')->where('user_id', auth()->id())->first();
        $this->products = $this->watchlist?->products ?? [];
    }

    public function deleteProduct($productId)
    {
        $watchlist = WatchListModal::where('user_id', auth()->id())->with('products')->first();

        if ($watchlist) {
            $product = Product::find($productId);
            $watchlist->products()->detach($product);
            $this->productCount=count($watchlist->products);
            $this->dispatch('updateCountWishlistComponent')->to('front.header');
        }
        // تحديث المنتجات بعد الحذف
        $this->getProducts();
    }

    public function render()
    {
        return view('livewire.front.watchlist');
    }
}
