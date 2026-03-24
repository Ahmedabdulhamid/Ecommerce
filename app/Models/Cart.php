<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products')
            ->withPivot('id', 'price', 'quantity', 'product_variant_id', 'attributes')
            ->withTimestamps();
    }
}
