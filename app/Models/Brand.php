<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Brand extends Model
{
    use FlushesFrontCache, HasFactory, HasTranslations, SoftDeletes, HasSlug;

    protected $guarded = ['id'];

    protected $casts = [
        'name' => 'array',
    ];

    protected $table = 'brands';

    public $translatable = ['name'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected static function frontCacheTags(): array
    {
        return ['front.home', 'front.brands', 'front.products'];
    }
}
