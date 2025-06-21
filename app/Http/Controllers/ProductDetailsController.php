<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\AttributeValue;

class ProductDetailsController extends Controller
{
    public function getProductDetails(String $slug)
    {
        $product = Product::where('slug', $slug)->with('tags', 'reviews.user.country', 'reviews.user.governorate', 'product_variants.product_attributes.attr_value.attribute')->firstOrFail();
        $attributeValueIds = $product->product_variants
            ->pluck('product_attributes') // تجيب كل product_attributes
            ->flatten(1)                  // تحولهم لـ Collection واحدة بدل nested
            ->pluck('attribute_value_id') // تجيب القيمة المطلوبة
            ->unique()                    // تشيل التكرار (اختياري)
            ->values();
            $productVariantsCount=$product->product_variants;
        $attributeValues=AttributeValue::whereIn('id',$attributeValueIds)->with('attribute')->get();




        $categoryId = $product->category_id;
        $sameProducts = Product::where('category_id', $categoryId)->limit(4)->get();
       //return $productVariantsCount;
       return view('front.products.productDetails', ['product' => $product, 'sameProducts' => $sameProducts,'attributeValues'=>$attributeValues]);
    }
}
