<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Governorate extends Model
{
    use HasFactory,HasTranslations;
    protected $table="governorates";
    protected $guarded=['id'];
    public $translatable = ['name'];

    protected $casts = [
        'name' => 'array', // تحديد أن الحقل من نوع JSON
    ];
    public function countary(){
        return $this->belongsTo(Countary::class);
    }
    public function cities(){
        return $this->hasMany(City::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
}
