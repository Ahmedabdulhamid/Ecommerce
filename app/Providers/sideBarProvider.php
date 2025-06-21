<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Countary;
use App\Models\Coupon;
use App\Models\Faq;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class sideBarProvider extends ServiceProvider
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

    }
}
