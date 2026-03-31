<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use FlushesFrontCache, HasFactory;

    protected $guarded = ['id'];

    protected $table = 'product_images';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function frontCacheTags(): array
    {
        return ['front.home', 'front.products'];
    }
}
