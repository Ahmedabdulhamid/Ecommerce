<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $productService)
    {
    }

    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }

        return view('dashboard.products.index');
    }

    public function getData()
    {
        $products = $this->productService->dataTableQuery();

        return DataTables::of($products)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->whereAny(['name->ar', 'name->en', 'small_desc->ar', 'small_desc->en', 'desc->ar', 'desc->en'], 'like', '%' . $search . '%');
                    });
                }
            })
            ->addColumn('name', function ($product) {
                return $product->getTranslation('name', app()->getLocale());
            })
            ->addColumn('status', function ($product) {
                return $product->status == 1 ? __('products.status_yes') : __('products.status_no');
            })
            ->addColumn('category', function ($product) {
                return $product->category?->getTranslation('name', app()->getLocale()) ?? __('admin.not_found');
            })
            ->addColumn('brand', function ($product) {
                return $product->brand?->getTranslation('name', app()->getLocale()) ?? __('admin.not_found');
            })
            ->addColumn('sku', function ($product) {
                return $product->sku;
            })
            ->addColumn('available_for', function ($product) {
                return $product->available_for;
            })
            ->addColumn('has_variants', function ($product) {
                return $product->has_variants == 0 ? __('products.has_variants_no') : __('products.has_variants_yes');
            })
            ->addColumn('has_discount', function ($product) {
                return $product->has_discount == 0 ? __('products.has_discount_no') : __('products.has_discount_yes');
            })
            ->addColumn('price', function ($product) {
                return $product->has_variants == 0 ? number_format($product->price, 2) : __('products.has_variants_yes');
            })
            ->addColumn('actions', function ($product) {
                return view('dashboard.products.action', ['product' => $product]);
            })
            ->make(true);
    }

    public function changeStatus()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }

        $this->productService->toggleStatus(request('id'));

        return response()->json(['msg' => 'The Status Updated Successfully']);
    }

    public function create()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }

        return view('dashboard.products.create', $this->productService->getCreateDependencies());
    }

    public function store(Request $request)
    {
    }

    public function show(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }

        return view('dashboard.products.show', [
            'product' => $this->productService->findForShow($id),
        ]);
    }

    public function edit(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }

        return view('dashboard.products.edit', $this->productService->getEditDependencies($id));
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }

        $count = $this->productService->deleteProduct(request('product', $id));

        return response()->json(['msg' => 'The Product has been Deleted', 'count' => $count]);
    }

    public function deleteVariant()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'product-manager'])) {
            abort(403);
        }

        $this->productService->deleteVariant(request('id'));

        return response()->json(['msg' => 'Variant Deleted Successfully']);
    }
}
