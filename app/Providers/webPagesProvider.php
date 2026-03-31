<?php

namespace App\Providers;

use App\Support\FrontCache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class webPagesProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::share('pages', FrontCache::pages());
        View::share('categories', FrontCache::rootCategories());
    }
}
