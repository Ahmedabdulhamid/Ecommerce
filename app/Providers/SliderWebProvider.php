<?php

namespace App\Providers;

use App\Models\Slider;
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
       $sliders=Slider::get();
       View::composer('front.layouts.hero',function($view) use($sliders){
           return $view->with('sliders',$sliders);
       });
    }
}
