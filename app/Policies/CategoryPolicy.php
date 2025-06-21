<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the Admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        $roles = Role::whereIn('id', [1, 3])->get();
        dd($roles);

        $roleNames = $roles->map(function ($role) {
            return $role->getTranslation('name', 'en');
        })->toArray();

        return $admin->hasAnyRole($roleNames);
    }

    /**
     * Determine whether the Admin can view the model.
     */
    public function view(Admin $admin, Category $category): bool
    {
        $roles = Role::whereIn('id', [2, 3])->get();

        $roleSlugs = $roles->pluck('slug')->toArray();

        $hasRole = $admin->roles->pluck('slug')->intersect($roleSlugs)->isNotEmpty();

        return $hasRole;
    }

    /**
     * Determine whether the Admin can create models.
     */
    public function create(Admin $admin): bool
    {
        $admin=Admin::where('id',auth()->guard('admin')->user()->id)->with('roles')->first();

         $roles = Role::whereIn('id', [2, 3])->get();

        $roleSlugs = $roles->pluck('slug')->toArray();

        $hasRole = $admin->roles->pluck('slug')->intersect($roleSlugs)->isNotEmpty();

        return $hasRole;
    }

    /**
     * Determine whether the Admin can update the model.
     */
    public function update(Admin $admin, Category $category): bool
    {
        $roles = Role::whereIn('id', [1, 3])->get();

        $roleNames = $roles->map(function ($role) {
            return $role->getTranslation('name', 'en');
        })->toArray();

        return $admin->hasAnyRole($roleNames);
    }

    /**
     * Determine whether the Admin can delete the model.
     */
    public function delete(Admin $admin, Category $category): bool
    {
        $roles = Role::whereIn('id', [1, 3])->get();

        $roleNames = $roles->map(function ($role) {
            return $role->getTranslation('name', 'en');
        })->toArray();

        return $admin->hasAnyRole($roleNames);
    }

    /**
     * Determine whether the Admin can restore the model.
     */

    /**
     * Determine whether the Admin can permanently delete the model.
     */
}
