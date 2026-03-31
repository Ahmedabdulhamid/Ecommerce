<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productAttribute extends Model
{
    use FlushesFrontCache, HasFactory;

    protected $guarded = ['id'];

    public function product_var()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function attr_value()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }

    protected static function frontCacheTags(): array
    {
        return ['front.products'];
    }
}
