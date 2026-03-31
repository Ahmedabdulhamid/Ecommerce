<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use FlushesFrontCache, HasFactory;

    protected $fillable = ['product_id', 'rating', 'user_id', 'comment'];

    protected $table = 'product_previews';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function frontCacheTags(): array
    {
        return ['front.products'];
    }
}
