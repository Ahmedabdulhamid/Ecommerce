<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\CollectionDataTable;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }
        return view('dashboard.products.index');
    }

    public function getData()
    {
        $products = Product::query()->with('category', 'brand', 'product_variants', 'productImages', 'tags');
        return DataTables::of($products)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->whereAny(['name->ar', 'name->en', 'small_desc->ar', 'small_desc->en', 'desc->ar', 'desc->en'], 'like', '%' . $search . '%');
                });
            }
        })->addColumn('name', function ($product) {
            return $product->getTranslation('name', app()->getLocale());
        })->addColumn('status', function ($product) {
            return $product->status == 1 ? __('products.status_yes') : __('products.status_no');
        })->addColumn('category', function ($product) {
            return $product->category->getTranslation('name', app()->getLocale());
        })->addColumn('brand', function ($product) {
            return $product->brand->getTranslation('name', app()->getLocale());
        })->addColumn('sku', function ($product) {
            return $product->sku;
        })->addColumn('available_for', function ($product) {
            return $product->available_for;
        })->addColumn('has_variants', function ($product) {
            return $product->has_variants == 0 ? __('products.has_variants_no') : __('products.has_variants_yes');
        })->addColumn('has_discount', function ($product) {
            return  $product->has_discount == 0 ? __('products.has_discount_no') : __('products.has_discount_yes');
        })->addColumn('price', function ($product) {
            return  $product->has_variants == 0 ? number_format($product->price, 2) : __('products.has_variants_yes');
        })->addColumn('actions', function ($product) {
            return view('dashboard.products.action', ['product' => $product]);
        })->make(true);
    }
    public function changeStatus()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }
        $product = Product::where('id', request('id'))->first();
        $product->update(['status' => $product->status == 1 ? 0 : 1]);
        return response()->json(['msg' => 'The Status Updated Successfully']);
    }
    public function create()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }
        $categories = Category::get();
        $brands = Brand::get();
        return view('dashboard.products.create', ['categories' => $categories, 'brands' => $brands]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }
        $product = Product::where('id', $id)->with('category', 'brand', 'product_variants', 'productImages', 'tags')->firstOrFail();

        //return $product->product_variants[0]->product_attributes[0]->attribute_value_id;
        return view('dashboard.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }
        $productId = $id;
        $product = Product::where('id', $id)->with('category', 'brand', 'product_variants.product_attributes', 'productImages', 'tags')->firstOrFail();
        $attributes = Attribute::get();
        $categories = Category::get();
        $brands = Brand::get();

        return view('dashboard.products.edit', ['attributes' => $attributes, 'categories' => $categories, 'brands' => $brands, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }
        $product = Product::where('id', request('product'))->first();
        $product->delete();
        return response()->json(['msg' => 'The Product has been Deleted', 'count' => Product::count()]);
    }

    public function deleteVariant()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }
        $variant = ProductVariant::where('id', request('id'))->first();
        $variant->delete();
        return response()->json(['msg' => 'Variant Deleted Successfully']);
    }
}
