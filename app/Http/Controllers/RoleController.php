<?php

namespace App\Http\Controllers;
use Flasher\Prime\FlasherInterface;
use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\Role;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }



        return view('dashboard.Roles.roles');
    }
 public function getData()
    {
        $roles = Role::with('permissions')->latest();

        return DataTables::of($roles)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->where('name->en', 'like', "%{$search}%")
                            ->orWhere('name->ar', 'like', "%{$search}%");
                    });
                }
            })
            ->addColumn('name', function ($role) {
                // ترجمة الاسم حسب اللغة الحالية
                return $role->getTranslation('name', app()->getLocale());
            })
            ->addColumn('actions', function ($role) {
                return view('dashboard.Roles.action', ['role' => $role])->render();
            })
            ->rawColumns(['actions'])  // لو الـ actions تحتوي HTML
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }


        $permissions = Permission::all();

        return view('dashboard.Roles.create_role', ['permissions' => $permissions]);
    }

    public function store(RoleRequest $request)
    {
        $data = $request->validated();
        $role = Role::create([
            'name' => [
                'en' => $data['role']['en'], // ترجمة باللغة الإنجليزية
                'ar' => $data['role']['ar'], // ترجمة باللغة العربية
            ],
            'guard_name' => 'admin',
        ]);
        $permissions=Permission::whereIn('id',$data['permissions'])->get();
        // $permissions;
        $role->givePermissionTo($permissions);
        if ($role) {
            Flasher::addSuccess('The Role added successfully!');
            return to_route('roles.index');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $permissions = Permission::all();
        /*foreach ($permissions as $perimission) {
            Gate::forUser(Auth::guard('admin')->user())->authorize($perimission->getTranslation('name', 'en'));
        }*/
        $permissions = Permission::all();
        $role = Role::where('id', $id)->get()[0];

        return view('dashboard.Roles.edit_role', ['permissions' => $permissions, 'role' => $role]);

    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $data=$request->validated();
        $role=Role::findOrFail($id);
        //$permissions= $data['permissions'];
        $permissions=Permission::whereIn('id',$data['permissions'])->get();


       $role->update([
            'name'=>[
                'en'=>$data['role']['en'],
                'ar'=>$data['role']['ar']
            ],
            'guard_name' => 'admin',
        ]);
        $role->syncPermissions($permissions);
        Flasher::addSuccess('The Role Updated Successfully!');
        return redirect()->route('roles.index');

    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }


         $role= Role::where('id', request('role'))->first();

        $role->delete();

    }


    public function showDetails(){
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin'])) {
            abort(403);
        }

        $role=Role::where('id',1)->with('permissions')->first();
         return $role;

    }


}
