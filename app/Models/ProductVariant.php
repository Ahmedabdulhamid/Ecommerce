<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use FlushesFrontCache, HasFactory;

    protected $guarded = ['id'];

    protected $table = 'product_variants';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function product_attributes()
    {
        return $this->hasMany(productAttribute::class);
    }

    public function cartProducts()
    {
        return $this->hasMany(CartProduct::class);
    }

    protected static function frontCacheTags(): array
    {
        return ['front.home', 'front.products'];
    }
}
