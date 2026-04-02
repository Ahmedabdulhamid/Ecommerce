<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAssignRoleRequest;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function __construct(private readonly AdminService $adminService)
    {
    }

    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        return view('dashboard.admins.index');
    }

    public function getData()
    {
        $admins = $this->adminService->query();
        $roles = $this->adminService->getRolesWithPermissions();

        return DataTables::of($admins)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->whereAny(['name', 'email'], 'like', '%' . $search . '%');
                    });
                }
            })
            ->addColumn('name', function ($admin) {
                return $admin->name;
            })
            ->addColumn('email', function ($admin) {
                return $admin->email;
            })
            ->addColumn('actions', function ($admin) use ($roles) {
                return view('dashboard.admins.actions', ['admin' => $admin, 'roles' => $roles]);
            })
            ->make(true);
    }

    public function assignRole(AdminAssignRoleRequest $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $this->adminService->assignRoles(request('admin', $request->route('admin')), $request->validated('roles'));

        return response()->json(['status' => 201, 'msg' => 'The Role was assigned successfully']);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(string $id)
    {
        $count = $this->adminService->delete(request('admin', $id));

        return response()->json([
            'msg' => 'Admin deleted successfully',
            'status' => 200,
            'countadmins' => $count,
        ]);
    }
}
