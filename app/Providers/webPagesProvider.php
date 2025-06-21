<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Page;
use App\Models\WatchList;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewView;

class webPagesProvider extends ServiceProvider
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
        // ثابت
        View::share('pages', Page::get());
        View::share('categories', Category::whereNull('parent_id')->with('children')->get());

        // ديناميكي (لأنها تخص كل مستخدم)

    }
}
