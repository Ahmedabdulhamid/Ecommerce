<?php

namespace App\Services;

use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Database\Eloquent\Builder;

class PermissionService
{
    public function __construct(private readonly PermissionRepository $permissions)
    {
    }

    public function query(): Builder
    {
        return $this->permissions->query();
    }

    public function create(array $data): Permission
    {
        return $this->permissions->create($data);
    }

    public function update(int|string $id, array $data): bool
    {
        $permission = $this->permissions->findByIdOrFail($id);

        return $this->permissions->update($permission, $data);
    }

    public function delete(int|string $id): void
    {
        $permission = $this->permissions->findByIdOrFail($id);
        $this->permissions->delete($permission);
    }
}
