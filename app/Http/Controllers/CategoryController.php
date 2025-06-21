<?php

namespace App\Http\Controllers;

use Flasher\Laravel\Facade\Flasher;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\CollectionDataTable;
use function PHPUnit\Framework\returnSelf;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Admin $admin, Category $category)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['super-admin', 'category-manager','admin'])) {
            abort(403);
        }
        return view('dashboard.categories.index');
    }


    public function getCategoriesData()
    {
        // استخدم query() بدلاً من all() لكي يتمكن Yajra DataTables من إضافة البيانات الإضافية مثل draw والصفوف الكلية.
        $categories = Category::query();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    // يمكنك تعديل منطق البحث هنا ليشمل أعمدة معينة
                    $query->where(function ($q) use ($search) {
                        $q->where('name->en', 'like', "%{$search}%")->orWhere("name->ar", 'like', "%{$search}%")
                            ->orWhere('status', 'like', "%{$search}%");
                    });
                }
            }) // لإضافة عمود فهرسة (DT_RowIndex)
            ->addColumn('name', function ($category) {
                return $category->getTranslation('name', app()->getLocale());
            })
            ->addColumn('status', function ($category) {
                return view('dashboard.categories.status', ['category' => $category]);
            })->addColumn('actions', function ($category) {
                return view('dashboard.categories.actions', ['category' => $category]);
            })


            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Admin $admin, Category $category)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }


        $categories = Category::whereNull('parent_id')->get();
        return view('dashboard.categories.create', ['categories' => $categories]);
    }
    public function editStatus(Request $request)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }
        $category = Category::find($request->id);
        $category->update([
            'status' => $category->status == "active" ? "inactive" : "active"
        ]);
        return response()->json(['message' => "Your Status Edited "]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }
        Gate::forUser(Auth::guard('admin')->user())->authorize('Category-management');
        $data = $request->validated();

        $category = Category::create($data);

        Flasher::addSuccess('The Category added successfully!');
        return to_route('categories.index');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }

        $category = Category::where('slug', $slug)->firstOrFail();
        $categories = Category::whereNull('parent_id')->where("id", "!=", $category->parent_id)->get();

        return view('dashboard.categories.edit', ['categories' => $categories, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $slug)
    {

   if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }
        $data = $request->validated();
        $category = Category::where('slug', $slug)->firstOrFail();
        $categoryUpdate = $category->update($data);
        if (!$categoryUpdate) {
            Flasher::addError('Something Error...');
        }
        Flasher::addSuccess('Your Category Updated Successfully..');
        return to_route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }
        $category = Category::findOrFail($id);
        $category->delete();
        return to_route('categories.index');
    }
    public function getRecycleBinData()
    {
       if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }
        $categories = Category::onlyTrashed()->get();
        return view('dashboard.categories.recycle', ['categories' => $categories]);
    }
    public function restoreCategory()
    {
       if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }
        $category = Category::onlyTrashed()->where('id', request('category'))->firstOrFail();
        $category->restore();
        //return request('category');

        Flasher::addSuccess('Your category is Restored Successfully...');
        return to_route('categories.index');
    }
    public function DeleteCategory()
    {
       if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }
        $category = Category::onlyTrashed()->where('id', request('category'))->firstOrFail();
        $category->forceDelete();
        return to_route('categories.index');
    }
    public function DeleteCategoryFinal()
    {
       if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager'])) {
            abort(403);
        }
        $category = Category::where('id', request('category'))->firstOrFail();
        $category->forceDelete();
        return to_route('categories.index');
    }
}
