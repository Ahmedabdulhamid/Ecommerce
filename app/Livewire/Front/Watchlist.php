<?php

namespace App\Livewire\Front;

use App\Services\WatchlistService;
use Livewire\Component;

class Watchlist extends Component
{
    public $products = [];
    public $watchlist;
    public $productCount;

    protected $listeners = ['getProducts' => 'getProducts'];

    public function mount(WatchlistService $watchlistService)
    {
        $this->getProducts($watchlistService);
    }

    public function getProducts(WatchlistService $watchlistService)
    {
        [$watchlist, $products] = $watchlistService->getUserWatchlistProducts(auth()->id());
        $this->watchlist = $watchlist;
        $this->products = $products;
    }

    public function deleteProduct($productId, WatchlistService $watchlistService)
    {
        $this->productCount = $watchlistService->removeProduct(auth()->id(), $productId);
        $this->dispatch('updateCountWishlistComponent')->to('front.header');
        $this->getProducts($watchlistService);
    }

    public function deleteWishlist(WatchlistService $watchlistService)
    {
        if (auth()->guard('web')->user()->id) {
            $this->productCount = $watchlistService->clear(auth()->id());
            $this->dispatch('updateCountWishlistComponent')->to('front.header');
        }

        $this->getProducts($watchlistService);
    }

    public function render()
    {
        return view('livewire.front.watchlist');
    }
}
