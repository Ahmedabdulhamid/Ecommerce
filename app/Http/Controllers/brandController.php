<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

use function PHPUnit\Framework\isNull;

class brandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        return view('dashboard.brands.index');
    }
    public function getBrandsData()
    {

        $brands = Brand::query();
        return DataTables::of($brands)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->where('name->en', 'like', '%' . $search . "%")->orWhere('name->ar', 'like', '%' . $search . "%");
                });
            }
        })->addColumn('name', function ($brand) {
            return $brand->getTranslation('name', app()->getLocale());
        })->addColumn('status', function ($brand) {
            return view('dashboard.brands.status',['brand' => $brand]);
        })->addColumn('image', function ($brand) {
            $logo = $brand->logo;
            if (filter_var($logo, FILTER_VALIDATE_URL)) {
                $src = $logo;
            } else {
                $src = asset('storage/logo/' . $logo);
            }
            return '<img src="' . $src . '" width="50px">';
        })->addColumn('actions', function ($brand) {
            return view('dashboard.brands.actions', ['brand' => $brand]);
        })
            ->rawColumns(['image', 'actions'])

            ->make(true);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        return view("dashboard.brands.create");
    }
    public function editStatus(Request $request)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        $brand = Brand::findOrFail($request->id);
        $brand->update([
            'status' => $brand->status == "active" ? "inactive" : "active"
        ]);
        return response()->json(['message' => "Your Status Edited "]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        $data = $request->validated();
        $logo = $request->logo;
        $newLogo = time() . '-' . $logo->getClientOriginalName();
        $logo->storeAs('logo', $newLogo, 'public');
        $data['logo'] = $newLogo;
        $brand = Brand::create($data);
        if ($brand) {
            Flasher::addSuccess('The Category added successfully!');
            return to_route('brands.index');
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        $brand=Brand::where('slug',$slug)->firstOrFail();
        return view('dashboard.brands.edit',['brand'=>$brand]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $slug)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        $data=$request->validated();
        $brand=Brand::where('slug',$slug)->firstOrFail();
        if ($request->logo) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($brand->logo && Storage::exists('public/logo/'.$brand->logo)) {
                Storage::delete('public/logo/'.$brand->logo);
            }

            // حفظ الصورة الجديدة
            $logo = $request->logo;
            $newLogo = time().'-'.$logo->getClientOriginalName();
            $logo->storeAs('logo',$newLogo,'public');
            $data['logo'] = $newLogo;
        }
        $brand->update($data);
        Flasher::addSuccess(__('brand.success_brand_update'));
        return to_route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        $category=Brand::findOrFail($id);
        $category->delete();
        return to_route('brands.index');
    }
    public function getRecycleBinData(){
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        $brands=Brand::onlyTrashed()->get();
        return view('dashboard.brands.recycle',['brands'=>$brands]);

    }
    public function restoreBrand(){
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
       $brand=Brand::onlyTrashed()->where('id',request('brand'))->firstOrFail();
       $brand->restore();
       //return request('category');

       Flasher::addSuccess('Your Brand is Restored Successfully...');
      return to_route('brands.index');
    }
    public function DeleteBrand(){
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        $brand=Brand::onlyTrashed()->where('id',request('brand'))->firstOrFail();
        $brand->forceDelete();
        return to_route('brands.index');
    }
    public function DeleteBrandFinal(){
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin','product-manager'])) {
            abort(403);
        }
        $brand=Brand::where('id',request('brand'))->firstOrFail();
        Storage::delete('public/logo/'.$brand->logo);
              $brand->forceDelete();

        return to_route('brands.index');
    }
}
