<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use FlushesFrontCache, HasFactory, HasTranslations, HasSlug;

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
    ];

    protected $guarded = ['id'];

    public $translatable = ['title', 'content'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    protected static function frontCacheTags(): array
    {
        return ['front.shared', 'front.pages'];
    }
}
