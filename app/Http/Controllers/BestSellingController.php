<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;
class BestSellingController extends Controller
{
    public function getBestSellingProducts()
    {
        $topSellingProducts = Product::withSum([
            'ordersItems as total_quantity' => function ($query) {
                $query->whereHas('order', function ($q) {
                    $q->where('status', 'delivered');
                });
            }
        ], 'quantity')
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get()
            ->filter(function ($product) {
                return $product->total_quantity > 0;
            });
        return view('front.products.topSelling', ['topSellingProducts' => $topSellingProducts]);
    }
    public function getBestSellingProductsWeekly()
    {
         $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $topSellingProductsInWeek = Product::withSum([
            'ordersItems as total_quantity' => function ($query) use ($startOfWeek, $endOfWeek) {
                $query->whereHas('order', function ($q) use ($startOfWeek, $endOfWeek) {
                    $q->where('status', 'delivered')
                        ->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                });
            }
        ], 'quantity')
            ->orderByDesc('total_quantity')
            ->take(10)
            ->get()
            ->filter(function ($product) {
                return $product->total_quantity > 0;
            });
            return view('front.products.topSellingWeekly',['topSellingProductsInWeek'=>$topSellingProductsInWeek]);
    }
}
