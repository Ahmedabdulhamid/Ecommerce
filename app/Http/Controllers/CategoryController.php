<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Services\CategoryService;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    public function index(Admin $admin, Category $category)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['super-admin', 'category-manager', 'admin'])) {
            abort(403);
        }

        return view('dashboard.categories.index');
    }

    public function getCategoriesData()
    {
        $categories = $this->categoryService->query();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->where('name->en', 'like', "%{$search}%")
                            ->orWhere('name->ar', 'like', "%{$search}%")
                            ->orWhere('status', 'like', "%{$search}%");
                    });
                }
            })
            ->addColumn('name', function ($category) {
                return $category->getTranslation('name', app()->getLocale());
            })
            ->addColumn('status', function ($category) {
                return view('dashboard.categories.status', ['category' => $category]);
            })
            ->addColumn('actions', function ($category) {
                return view('dashboard.categories.actions', ['category' => $category]);
            })
            ->make(true);
    }

    public function create(Admin $admin, Category $category)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['super-admin', 'admin', 'category-manager'])) {
            abort(403);
        }

        return view('dashboard.categories.create', [
            'categories' => $this->categoryService->getRootCategories(),
        ]);
    }

    public function editStatus(Request $request)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['super-admin', 'admin', 'category-manager'])) {
            abort(403);
        }

        $this->categoryService->toggleStatus($request->id);

        return response()->json(['message' => 'Your Status Edited ']);
    }

    public function store(CategoryRequest $request)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['super-admin', 'admin', 'category-manager'])) {
            abort(403);
        }

        $this->categoryService->create($request->validated());

        Flasher::addSuccess('The Category added successfully!');

        return to_route('categories.index');
    }

    public function edit(string $slug)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['super-admin', 'admin', 'category-manager'])) {
            abort(403);
        }

        $category = $this->categoryService->findBySlug($slug);

        return view('dashboard.categories.edit', [
            'categories' => $this->categoryService->getEditableParents($category),
            'category' => $category,
        ]);
    }

    public function update(UpdateCategoryRequest $request, string $slug)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['super-admin', 'admin', 'category-manager'])) {
            abort(403);
        }

        $updated = $this->categoryService->updateBySlug($slug, $request->validated());

        if (!$updated) {
            Flasher::addError('Something Error...');
        }

        Flasher::addSuccess('Your Category Updated Successfully..');

        return to_route('categories.index');
    }

    public function destroy(string $id)
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['super-admin', 'admin', 'category-manager'])) {
            abort(403);
        }

        $this->categoryService->deleteById($id);

        return to_route('categories.index');
    }

    public function getRecycleBinData()
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager', 'super-admin'])) {
            abort(403);
        }

        return view('dashboard.categories.recycle', [
            'categories' => $this->categoryService->getRecycleBin(),
        ]);
    }

    public function restoreCategory()
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager', 'super-admin'])) {
            abort(403);
        }

        $this->categoryService->restoreById(request('category'));

        Flasher::addSuccess('Your category is Restored Successfully...');

        return to_route('categories.index');
    }

    public function DeleteCategory()
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager', 'super-admin'])) {
            abort(403);
        }

        $this->categoryService->forceDeleteTrashedById(request('category'));

        return to_route('categories.index');
    }

    public function DeleteCategoryFinal()
    {
        if (!Gate::forUser(Auth::guard('admin')->user())->any(['admin', 'category-manager', 'super-admin'])) {
            abort(403);
        }

        $this->categoryService->forceDeleteById(request('category'));

        return to_route('categories.index');
    }
}
