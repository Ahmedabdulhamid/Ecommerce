<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\SlugOptions;
use Spatie\Sluggable\HasSlug;
class Brand extends Model
{
    use HasFactory,HasTranslations,SoftDeletes;
    use HasSlug;
    protected $guarded=['id'];

    protected $casts = [
        'name' => 'array', // يحوّل `name` إلى JSON تلقائيًا
    ];
    protected $table="brands";
    public $translatable = ['name'];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name') // استخدم الاسم بالإنجليزية لإنشاء `slug`
            ->saveSlugsTo('slug');
    }
    public function products(){
        return $this->hasMany(Product::class);
    }

}
