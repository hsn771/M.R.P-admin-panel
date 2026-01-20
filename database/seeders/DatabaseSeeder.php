<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure base permissions exist
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users', 'guard_name' => 'web']);
        $manageRoles = Permission::firstOrCreate(['name' => 'manage roles', 'guard_name' => 'web']);
        $managePermissions = Permission::firstOrCreate(['name' => 'manage permissions', 'guard_name' => 'web']);

        // Ensure an admin role exists and has all permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions([$manageUsers, $manageRoles, $managePermissions]);

        // Create or update an admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'), // change in production
            ]
        );

        // Assign the admin role
        if (! $admin->hasRole($adminRole->name)) {
            $admin->assignRole($adminRole);
        }
    }
}
