<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory,HasTranslations;
    protected $table='attributes';
    protected $fillable=[
        'name'
    ];
    protected $translatable=['name'];
    protected $casts = [
        'name' => 'array',
    ];
    public function attr_values(){
        return $this->hasMany(AttributeValue::class,'attr_id');
    }
}
