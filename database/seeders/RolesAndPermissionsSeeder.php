<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'edit tickets']);
        Permission::create(['name' => 'delete tickets']);
        Permission::create(['name' => 'view tickets']);
        Permission::create(['name' => 'assign tickets']);
        Permission::create(['name' => 'close tickets']);

        // Create roles and assign permissions


        $supportRole = Role::create(['name' => 'support', 'guard_name' => 'web']);
        $supportRole->givePermissionTo([
            'create tickets',
            'edit tickets',
            'view tickets',
            'assign tickets',
            'close tickets'
        ]);
        $supportRole->givePermissionTo([
            'create tickets',
            'edit tickets',
            'view tickets',
            'assign tickets',
            'close tickets'
        ]);

        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
