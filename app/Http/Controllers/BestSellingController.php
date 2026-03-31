<?php

namespace App\Http\Controllers;

use App\Support\FrontCache;

class BestSellingController extends Controller
{
    public function getBestSellingProducts()
    {
        return view('front.products.topSelling', [
            'topSellingProducts' => FrontCache::bestSellingProducts(),
        ]);
    }

    public function getBestSellingProductsWeekly()
    {
        return view('front.products.topSellingWeekly', [
            'topSellingProductsInWeek' => FrontCache::bestSellingProductsWeekly(),
        ]);
    }
}
