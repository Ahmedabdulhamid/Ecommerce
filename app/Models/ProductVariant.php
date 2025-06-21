<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $table="product_variants";
    public function product(){
        return $this->belongsTo(Product::class);

    }
    public function product_attributes(){
        return $this->hasMany(productAttribute::class);
    }
    public function cartProducts()
{
    return $this->hasMany(CartProduct::class);
}

}
