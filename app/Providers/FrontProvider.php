<?php

namespace App\Providers;

use App\Support\FrontCache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class FrontProvider extends ServiceProvider
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
        View::composer('livewire.front.header', function ($view) {
            return $view->with('shoppingCategories', FrontCache::headerCategories());
        });
    }
}
