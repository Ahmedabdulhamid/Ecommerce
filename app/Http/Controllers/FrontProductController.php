<?php

namespace App\Http\Controllers;

use App\Support\FrontCache;

class FrontProductController extends Controller
{
    public function getProductsByCategories(string $slug)
    {
        return view('front.products.products_by_categories', [
            'products' => FrontCache::productsByCategorySlug($slug),
        ]);
    }

    public function getProductsByBrand(string $slug)
    {
        return view('front.products.products_by_categories', [
            'products' => FrontCache::productsByBrandSlug($slug),
        ]);
    }

    public function getArrivalProducts()
    {
        return view('front.products.products_by_categories', [
            'products' => FrontCache::arrivalProducts(),
        ]);
    }

    public function getProducts($type)
    {
        if ($type === 'flash') {
            return view('front.products.products_by_categories', [
                'products' => FrontCache::flashProducts(),
                'type' => $type,
            ]);
        }

        if ($type === 'flash_timer') {
            return view('front.products.products_by_categories', [
                'products' => FrontCache::flashTimerProducts(),
                'type' => $type,
            ]);
        }

        abort(404);
    }
}
