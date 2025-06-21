<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        return view('dashboard.admins.index');
    }
    public function getData()
    {
        $admins = Admin::query();
        $roles = Role::with('permissions')->get();
        return DataTables::of($admins)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->whereAny(['name', 'email'], 'like', '%' . $search . '%');
                });
            }
        })->addColumn('name', function ($admin) {
            return $admin->name;
        })->addColumn('email', function ($admin) {
            return $admin->email;
        })->addColumn('actions', function ($admin) use ($roles) {
            return view('dashboard.admins.actions', ['admin' => $admin, 'roles' => $roles]);
        })->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function assignRole(Request $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $admin = Admin::find(request('admin'));
        $data = $request->validate([
            'roles' => ['required', 'array', "min:1"],
            'roles.*' => ['required']
        ]);
        $roles = Role::whereIn('id', $data['roles'])->get();

        $admin->assignRole($roles);
        return response()->json(['status' => 201, 'msg' => "The Role was assigned successfully"]);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
