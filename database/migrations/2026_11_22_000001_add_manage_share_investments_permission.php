<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Creates the "manage share investments" permission and gives it to the admin role,
 * so the Share Investments menu works right after `php artisan migrate`
 * (no need to re-run the RolesAndPermissionsSeeder on the server).
 */
return new class extends Migration
{
    private const PERMISSION = 'manage share investments';

    public function up(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permission = Permission::firstOrCreate(['name' => self::PERMISSION, 'guard_name' => 'web']);

        $adminRole = Role::where('name', 'admin')->where('guard_name', 'web')->first();
        if ($adminRole && !$adminRole->hasPermissionTo($permission)) {
            $adminRole->givePermissionTo($permission);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
        Permission::where('name', self::PERMISSION)->where('guard_name', 'web')->delete();
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
