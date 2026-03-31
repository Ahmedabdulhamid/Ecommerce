<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use FlushesFrontCache, HasFactory, HasTranslations, HasSlug, Searchable;

    protected $casts = [
        'name' => 'array',
    ];

    protected $guarded = ['id'];

    protected $translatable = ['name', 'small_desc', 'desc'];

    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name_en' => $this->getTranslation('name', 'en'),
            'name_ar' => $this->getTranslation('name', 'ar'),
            'category_en' => $this->category?->getTranslation('name', 'en'),
            'category_ar' => $this->category?->getTranslation('name', 'ar'),
            'brand_en' => $this->brand?->getTranslation('name', 'en'),
            'brand_ar' => $this->brand?->getTranslation('name', 'ar'),
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function product_variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products')
            ->withPivot('price', 'quantity', 'product_variant_id', 'attributes')
            ->withTimestamps();
    }

    public function formatDiscount()
    {
        if ($this->has_discount) {
            return rtrim(rtrim(number_format($$this->dicount, 2, '.', ''), '0'), '.');
        }

        return null;
    }

    public function whatchlists()
    {
        return $this->belongsToMany(WatchList::class, '_watchlist_products', 'product_id', 'watchlist_id');
    }

    public function getFinalPriceAttribute()
    {
        if ($this->has_discount) {
            return round($this->price * (1 - $this->discount / 100), 2);
        }

        return $this->price;
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function ordersItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    protected static function frontCacheTags(): array
    {
        return ['front.home', 'front.products'];
    }
}
