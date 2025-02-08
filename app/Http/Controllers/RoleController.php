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

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perimissions = Permission::all();
        /*foreach ($perimissions as $perimission) {
            Gate::forUser(Auth::guard('admin')->user())->authorize($perimission->getTranslation('name', 'en'));
        }*/

        $roles = Role::with('permissions')->get();

        return view('dashboard.Roles.roles', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


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
       $role=Role::findOrFail($id);
       $role->delete();
       Flasher::addSuccess('Role deleted successfully');
       return redirect()->route('roles.index');
    }
}
