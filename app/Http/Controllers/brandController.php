<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Services\BrandService;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class brandController extends Controller
{
    public function __construct(private readonly BrandService $brandService)
    {
    }

    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        return view('dashboard.brands.index');
    }

    public function getBrandsData()
    {
        $brands = $this->brandService->query();

        return DataTables::of($brands)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->where('name->en', 'like', '%' . $search . '%')
                            ->orWhere('name->ar', 'like', '%' . $search . '%');
                    });
                }
            })
            ->addColumn('name', function ($brand) {
                return $brand->getTranslation('name', app()->getLocale());
            })
            ->addColumn('status', function ($brand) {
                return view('dashboard.brands.status', ['brand' => $brand]);
            })
            ->addColumn('image', function ($brand) {
                $logo = $brand->logo;
                $src = filter_var($logo, FILTER_VALIDATE_URL) ? $logo : asset('storage/logo/' . $logo);

                return '<img src="' . $src . '" width="50px">';
            })
            ->addColumn('actions', function ($brand) {
                return view('dashboard.brands.actions', ['brand' => $brand]);
            })
            ->rawColumns(['image', 'actions'])
            ->make(true);
    }

    public function create()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        return view('dashboard.brands.create');
    }

    public function editStatus(Request $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        $this->brandService->toggleStatus($request->id);

        return response()->json(['message' => 'Your Status Edited ']);
    }

    public function store(BrandRequest $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        $brand = $this->brandService->create($request->validated(), $request->file('logo'));

        if ($brand) {
            Flasher::addSuccess('The Brand added successfully!');

            return to_route('brands.index');
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $slug)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        return view('dashboard.brands.edit', [
            'brand' => $this->brandService->findBySlug($slug),
        ]);
    }

    public function update(UpdateBrandRequest $request, string $slug)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        $this->brandService->updateBySlug($slug, $request->validated(), $request->file('logo'));

        Flasher::addSuccess(__('brand.success_brand_update'));

        return to_route('brands.index');
    }

    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        $this->brandService->deleteById($id);

        return to_route('brands.index');
    }

    public function getRecycleBinData()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        return view('dashboard.brands.recycle', [
            'brands' => $this->brandService->getRecycleBin(),
        ]);
    }

    public function restoreBrand()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        $this->brandService->restoreById(request('brand'));

        Flasher::addSuccess('Your Brand is Restored Successfully...');

        return to_route('brands.index');
    }

    public function DeleteBrand()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        $this->brandService->forceDeleteTrashedById(request('brand'));

        return to_route('brands.index');
    }

    public function DeleteBrandFinal()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'admin', 'product-manager'])) {
            abort(403);
        }

        $this->brandService->forceDeleteById(request('brand'));

        return to_route('brands.index');
    }
}
