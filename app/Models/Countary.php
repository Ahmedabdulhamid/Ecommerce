<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations as TranslatableHasTranslations;

class Countary extends Model
{
    use HasFactory,TranslatableHasTranslations;
    protected $table="countaries";
    public $translatable = ['name'];
    protected $guarded=['id'];
    public function governorates(){
        return $this->hasMany(Governorate::class);
    }
}
