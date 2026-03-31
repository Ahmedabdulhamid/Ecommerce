<?php

namespace App\Models;

use App\Models\Concerns\FlushesFrontCache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use FlushesFrontCache, HasFactory, HasTranslations;

    protected $fillable = ['id', 'questions', 'answers'];

    protected $translatable = ['questions', 'answers'];

    protected $casts = [
        'questions' => 'array',
        'answers' => 'array',
    ];

    protected static function frontCacheTags(): array
    {
        return ['front.faqs'];
    }
}
