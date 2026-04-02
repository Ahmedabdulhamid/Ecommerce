<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

class PermissionRepository
{
    public function query(): Builder
    {
        return Permission::latest();
    }

    public function create(array $data): Permission
    {
        return Permission::create($data);
    }

    public function findByIdOrFail(int|string $id): Permission
    {
        return Permission::findOrFail($id);
    }

    public function update(Permission $permission, array $data): bool
    {
        return $permission->update($data);
    }

    public function delete(Permission $permission): ?bool
    {
        return $permission->delete();
    }
}
