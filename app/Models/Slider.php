<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use FlushesFrontCache, HasFactory, HasTranslations;

    protected $table = 'sliders';

    protected $translatable = ['note'];

    public $fillable = ['note', 'file_name'];

    protected $casts = ['note' => 'array'];

    protected static function frontCacheTags(): array
    {
        return ['front.shared', 'front.sliders'];
    }
}
