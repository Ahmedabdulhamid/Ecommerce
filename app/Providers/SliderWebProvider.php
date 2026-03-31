<?php

namespace App\Providers;

use App\Support\FrontCache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SliderWebProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('front.layouts.hero', function ($view) {
            return $view->with('sliders', FrontCache::sliders());
        });
    }
}
