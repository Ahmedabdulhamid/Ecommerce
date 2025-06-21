<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Illuminate\Support\Facades\Gate;
class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        return view('dashboard.permissions.index');
    }
    public function getData()
    {
        $persmissions = Permission::latest();
        return DataTables::of($persmissions)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->whereAny(['name->en', 'name->ar'], 'like', '%' . $search . '%');
                });
            }
        })->addColumn('name', function ($permission) {
            return $permission->getTranslation('name', app()->getLocale());
        })->addColumn('actions', function ($permission) {
            return view('dashboard.permissions.actions', ['permission' => $permission]);
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $data = $request->validated();
        $permission = Permission::create($data);
        if ($permission) {
            return response()->json([
                'status' => 201,
                'data' => $permission
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $data = $request->validate([
            'name' => ['required', 'array'],
            'name.*' => [
                'required',
                'string',
                UniqueTranslationRule::for('permissions')
            ]
        ]);
        $permission = Permission::where('id', request('permission'))->first();
        $permission->update($data);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }
         $permission = Permission::where('id', request('permission'))->first();
        $permission->delete();

    }
}
