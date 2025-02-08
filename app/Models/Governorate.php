<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use HasFactory,HasTranslations;
    protected $table="governorates";
    public $translatable = ['name'];
    public function countary(){
        return $this->belongsTo(Countary::class);
    }
    public function cities(){
        return $this->hasMany(City::class);
    }

}
