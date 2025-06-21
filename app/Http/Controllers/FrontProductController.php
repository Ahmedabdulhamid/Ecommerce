<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontProductController extends Controller
{
   public function getProductsByCategories (string $slug)
   {
      $category=Category::where('slug',$slug)->first();
      $products=Product::where('category_id',$category->id)->with('images','brand','category')->get();
      return view('front.products.products_by_categories',['products'=>$products]);
   }
   public function getProductsByBrand(string $slug){
    $brand=Brand::where('slug',$slug)->first();
    $products=Product::where('brand_id',$brand->id)->with('images','brand','category')->get();
    return view('front.products.products_by_categories',['products'=>$products]);

   }
   public function getArrivalProducts(){
    $products = Product::with('images', 'category', 'brand')->latest()->get();
    return view('front.products.products_by_categories',['products'=>$products]);
   }
   public function getProducts($type){
    if ($type=='flash') {
        $products = Product::with('images', 'category', 'brand')->latest()->where('has_discount',1)->get();
        return view('front.products.products_by_categories',['products'=>$products,'type'=>$type]);
    }elseif($type=='flash_timer'){
        $products = Product::where('has_discount',1)->with('images', 'category', 'brand')->where('available_for',date('y-m-d'))->get();
        return view('front.products.products_by_categories',['products'=>$products,'type'=>$type]);
    }

   }
}
