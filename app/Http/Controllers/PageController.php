<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
        return view('dashboard.pages.index');
    }
    public function getData()
    {
        $pages = Page::query();
        return DataTables::of($pages)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->whereAny(['title->en', 'title->ar', 'content->ar', 'content->en'], 'like', '%' . $search . '%');
                });

                # code...
            }
        })->addColumn('title', function ($page) {
            return $page->getTranslation('title', app()->getLocale());
        })->addColumn('content', function ($page) {
            return $page->getTranslation('content', app()->getLocale());
        })->addColumn('image', function ($page) {
            if ($page->image == null) {
                return __('sliders.not_found');
            } else {
                return view('dashboard.pages.images');
            }
        })->addColumn('actions', function ($page) {
            return view('dashboard.pages.actions', ['page' => $page]);
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
        return view('dashboard.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
        $data = $request->validated();
        if ($request->image) {
            $image = $request->image;
            $newImage = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('pages', $newImage, 'public');
            $data['image'] = $newImage;
        }
        $page = Page::create($data);
        if ($page) {
            Flasher::addSuccess('The Page added successfully!');
            return to_route('pages.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
       return view('dashboard.pages.show',['page'=>$page]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
        return view('dashboard.pages.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePageRequest $request, Page $page)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
        $data = $request->validated();
        if ($request->image) {
            Storage::delete('public/pages/' . $page->image);
            $image = $request->image;
            $newImage = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('pages', $newImage, 'public');
            $data['image'] = $newImage;
        }
        $page->update($data);
        Flasher::addSuccess('The Page Updated successfully!');
        return to_route('pages.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
       $page->delete();
       return response()->json(['msg'=>'The Page Has Been Deleted Successfully']);
    }
}
