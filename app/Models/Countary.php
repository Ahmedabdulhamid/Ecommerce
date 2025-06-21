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

    protected $casts = [
        'name' => 'array', // تحديد أن الحقل من نوع JSON
    ];
    public function governorates(){
        return $this->hasMany(Governorate::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
