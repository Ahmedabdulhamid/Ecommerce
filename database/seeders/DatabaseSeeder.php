<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeederl;
use Database\Seeders\PermissionSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
        AdminSeeder::class,
        PermissionSeeder::class,
        AddAdminSeeder::class,
        AssignRolesSeeder::class,
        RoleSeeder::class,
        CountarySeeder::class,
        GovernorateSeeder::class,
        CitySeeder::class

      ]);
    }
}
