<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('s');
        $scoutResults = Product::search($query)->get();
        $ids = $scoutResults->pluck('id');

        // Step 3: Load full products with relationships
        $products = Product::whereIn('id', $ids)
            ->with(['images', 'product_variants']) // صححت كتابة variants
            ->get();

        return view('front.products.search',['products'=>$products]);
    }
}
