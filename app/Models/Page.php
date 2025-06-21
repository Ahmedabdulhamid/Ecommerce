<?php

namespace App\Models;
use Spatie\Sluggable\HasSlug;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory,HasTranslations;
    use HasSlug;
    protected $casts = [
        'title' => 'array',
        'content'=>"array" // يحوّل `title` إلى JSON تلقائيًا
    ];
    protected $guarded=['id'];
    public $translatable = ['title','content'];
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title') // استخدم الاسم بالإنجليزية لإنشاء `slug`
            ->saveSlugsTo('slug');
    }
}
