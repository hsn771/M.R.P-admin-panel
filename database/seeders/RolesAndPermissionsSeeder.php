<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions
        $permissions = [
            'access admin',
            'manage users',
            'manage roles',
            'manage permissions',
            'manage photo galleries',
            'manage abouts',
            'manage member registrations',
            'manage agent registrations',
            'manage sub agent registrations',
            'manage share investments',
            'manage contacts',
            'manage our details',
            'manage vacancies',
            'manage job applications',
            'manage events',
            'manage event registrations',
            'manage news',
            'manage our initials',
            'manage our milestones',
            'manage our leaderships',
            'manage our missions',
            'manage homes',
            'manage subscribers',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create Admin Role and assign all permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->syncPermissions(Permission::all());

        // Ensure Rifat role has access admin permission at least
        $rifatRole = Role::firstOrCreate(['name' => 'Rifat', 'guard_name' => 'web']);
        $rifatRole->givePermissionTo('access admin');
    }
}
