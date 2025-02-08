<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin=Admin::find(2);
        $role=Role::find(2);
        $admin->assignRole($role);
    }
}
