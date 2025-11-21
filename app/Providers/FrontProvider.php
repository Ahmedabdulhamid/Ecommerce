<?php

namespace App\Providers;

use App\Models\Category;
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

        $shoppingCategories=Category::where('parent_id',null)->with('children')->limit(4)->get();
        View::composer('livewire.front.header',function($view) use($shoppingCategories){
           return $view->with('shoppingCategories', $shoppingCategories);
       });

    }
}
