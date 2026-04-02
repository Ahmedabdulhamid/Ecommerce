<?php

namespace App\Services;

use App\Models\Admin;
use App\Repositories\AdminRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AdminService
{
    public function __construct(private readonly AdminRepository $admins)
    {
    }

    public function query(): Builder
    {
        return $this->admins->query();
    }

    public function getRolesWithPermissions(): Collection
    {
        return $this->admins->getRolesWithPermissions();
    }

    public function assignRoles(int|string $adminId, array $roleIds): void
    {
        $admin = $this->admins->findByIdOrFail($adminId);
        $roles = $this->admins->getRolesByIds($roleIds);
        $admin->syncRoles($roles);
    }

    public function delete(int|string $id): int
    {
        $admin = $this->admins->findByIdOrFail($id);
        $this->admins->delete($admin);

        return $this->admins->count();
    }

    public function create(array $data): Admin
    {
        return Admin::create([
            ...$data,
            'password' => Hash::make($data['password']),
        ]);
    }
}
