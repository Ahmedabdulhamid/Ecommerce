<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory,HasTranslations;
    protected $table="sliders";
    protected $translatable=['note'];
    public $fillable=['note','file_name'];
   protected $casts=["note"=>"array"];
}
