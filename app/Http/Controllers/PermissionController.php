<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Services\PermissionService;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function __construct(private readonly PermissionService $permissionService)
    {
    }

    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        return view('dashboard.permissions.index');
    }

    public function getData()
    {
        $persmissions = $this->permissionService->query();

        return DataTables::of($persmissions)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->whereAny(['name->en', 'name->ar'], 'like', '%' . $search . '%');
                    });
                }
            })
            ->addColumn('name', function ($permission) {
                return $permission->getTranslation('name', app()->getLocale());
            })
            ->addColumn('actions', function ($permission) {
                return view('dashboard.permissions.actions', ['permission' => $permission]);
            })
            ->make(true);
    }

    public function create()
    {
    }

    public function store(PermissionRequest $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $permission = $this->permissionService->create($request->validated());

        if ($permission) {
            return response()->json([
                'status' => 201,
                'data' => $permission,
            ]);
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(PermissionUpdateRequest $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $this->permissionService->update(request('permission', $id), $request->validated());
    }

    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $this->permissionService->delete(request('permission', $id));
    }
}
