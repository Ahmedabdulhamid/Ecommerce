<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory,HasTranslations;
    protected $table="cities";
    public $translatable = ['name'];
    public function governorate(){
        return $this->belongsTo(Governorate::class);
    }

}
