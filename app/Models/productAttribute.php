<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productAttribute extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function product_var(){
        return $this->belongsTo(ProductVariant::class);
    }
    public function attr_value(){
        return $this->belongsTo(AttributeValue::class,'attribute_value_id');
    }

}
