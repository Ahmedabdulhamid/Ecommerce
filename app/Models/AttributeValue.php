<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use FlushesFrontCache, HasFactory;

    protected $fillable = [
        'value',
        'attr_id',
    ];

    protected $table = 'attribute_values';

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attr_id');
    }

    public function product_attributes()
    {
        return $this->hasMany(productAttribute::class, 'product_variant_id');
    }

    protected static function frontCacheTags(): array
    {
        return ['front.products'];
    }
}
