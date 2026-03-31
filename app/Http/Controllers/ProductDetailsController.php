<?php

namespace App\Http\Controllers;

use App\Support\FrontCache;

class ProductDetailsController extends Controller
{
    public function getProductDetails(string $slug)
    {
        $product = FrontCache::productDetailsBySlug($slug);
        $sameProducts = FrontCache::sameProductsByCategoryId($product->category_id);

        return view('front.products.productDetails', [
            'product' => $product,
            'sameProducts' => $sameProducts,
        ]);
    }
}
