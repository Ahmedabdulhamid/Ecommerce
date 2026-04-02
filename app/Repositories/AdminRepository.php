<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository
{
    public function query(): Builder
    {
        return Admin::query();
    }

    public function count(): int
    {
        return Admin::count();
    }

    public function findByIdOrFail(int|string $id): Admin
    {
        return Admin::findOrFail($id);
    }

    public function getRolesWithPermissions(): Collection
    {
        return Role::with('permissions')->get();
    }

    public function getRolesByIds(array $ids): Collection
    {
        return Role::whereIn('id', $ids)->get();
    }

    public function delete(Admin $admin): ?bool
    {
        return $admin->delete();
    }
}
