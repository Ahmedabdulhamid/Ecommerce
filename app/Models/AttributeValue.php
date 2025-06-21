<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;
    protected $fillable=[
        'value',
        'attr_id'
    ];
    protected $table='attribute_values';
    public function attribute(){
        return $this->belongsTo(Attribute::class,'attr_id');
    }
    public function product_attributes(){
        return $this->hasMany(productAttribute::class,'product_variant_id');
    }
}
