<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\WatchlistRepository;

class WatchlistService
{
    public function __construct(private readonly WatchlistRepository $watchlists)
    {
    }

    public function getUserWatchlistProducts(?int $userId): array
    {
        if (!$userId) {
            return [null, []];
        }

        $watchlist = $this->watchlists->getUserWatchlistWithProducts($userId);

        return [$watchlist, $watchlist?->products ?? []];
    }

    public function removeProduct(?int $userId, int|string $productId): int
    {
        if (!$userId) {
            return 0;
        }

        $watchlist = $this->watchlists->getUserWatchlistWithProducts($userId);

        if (!$watchlist) {
            return 0;
        }

        $product = Product::find($productId);
        $watchlist->products()->detach($product);

        return $watchlist->products()->count();
    }

    public function clear(?int $userId): int
    {
        if (!$userId) {
            return 0;
        }

        $watchlist = $this->watchlists->getUserWatchlistWithProducts($userId);

        if (!$watchlist) {
            return 0;
        }

        $watchlist->products()->detach($watchlist->products);

        return $watchlist->products()->count();
    }
}
