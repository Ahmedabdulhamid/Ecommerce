<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    use HasFactory;

    protected $table = 'wishlists';

    protected $fillable = [
        'user_id',
        'product_id',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, '_watchlist_products', 'watchlist_id', 'product_id');
    }

}
