<?php

namespace App\Models\Concerns;

use App\Support\FrontCache;
use Illuminate\Database\Eloquent\SoftDeletes;

trait FlushesFrontCache
{
    protected static function bootFlushesFrontCache(): void
    {
        $flush = static function (): void {
            FrontCache::flush(static::frontCacheTags());
        };

        static::saved($flush);
        static::deleted($flush);

        if (in_array(SoftDeletes::class, class_uses_recursive(static::class), true)) {
            static::restored($flush);
            static::forceDeleted($flush);
        }
    }

    protected static function frontCacheTags(): array
    {
        return [];
    }
}
