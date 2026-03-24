<?php

namespace App\Http\Controllers;

use Algolia\AlgoliaSearch\Exceptions\NotFoundException;
use App\Models\Product;
use Illuminate\Http\Request;
use Throwable;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim((string) $request->input('s', ''));

        if ($query === '') {
            return view('front.products.search', ['products' => collect()]);
        }

        try {
            $scoutResults = Product::search($query)->get();
            $ids = $scoutResults->pluck('id');

            $products = Product::whereIn('id', $ids)
                ->with(['images', 'product_variants'])
                ->get();
        } catch (NotFoundException|Throwable $e) {
            // Local fallback when Algolia index is missing/unavailable.
            $products = Product::query()
                ->where('name->en', 'like', '%' . $query . '%')
                ->orWhere('name->ar', 'like', '%' . $query . '%')
                ->with(['images', 'product_variants'])
                ->get();
        }

        return view('front.products.search', ['products' => $products]);
    }
}
