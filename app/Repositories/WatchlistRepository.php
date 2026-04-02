<?php

namespace App\Repositories;

use App\Models\WatchList;

class WatchlistRepository
{
    public function getUserWatchlistWithProducts(int $userId): ?WatchList
    {
        return WatchList::where('user_id', $userId)
            ->with('products')
            ->first();
    }
}
