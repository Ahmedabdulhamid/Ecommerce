<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\SlugOptions;
class Category extends Model
{
    use HasFactory,HasTranslations,SoftDeletes;
    use HasSlug;
    protected $table="categories";
    protected $casts = [
        'name' => 'array', // يحوّل `name` إلى JSON تلقائيًا
    ];
    public $translatable = ['name'];
    protected $guarded=['id'];
    public function children(){
        return $this->hasMany(Category::class,'parent_id');
    }
    public function parent(){
        return $this->belongsTo(Category::class,'parent_id');
    }
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
