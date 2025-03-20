<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Dashboard Permissions
        Permission::create(['name' => 'dashboard.view']);
        Permission::create(['name' => 'dashboard.analytics']);

        // Ticket Permissions
        Permission::create(['name' => 'ticket.view.any']);     // View all tickets
        Permission::create(['name' => 'ticket.view.own']);     // View own tickets
        Permission::create(['name' => 'ticket.create']);       // Create ticket
        Permission::create(['name' => 'ticket.edit']);         // Edit ticket
        Permission::create(['name' => 'ticket.delete']);       // Delete ticket
        Permission::create(['name' => 'ticket.assign']);       // Assign ticket
        Permission::create(['name' => 'ticket.update.status']); // Update ticket status
        Permission::create(['name' => 'ticket.comment']);      // Comment on ticket

        // Access Request Permissions
        Permission::create(['name' => 'access-request.view.any']);     // View all access requests
        Permission::create(['name' => 'access-request.view.own']);     // View own access requests
        Permission::create(['name' => 'access-request.create']);       // Create new access request
        Permission::create(['name' => 'access-request.edit']);         // Edit access request
        Permission::create(['name' => 'access-request.delete']);       // Delete access request

        // Access Request Status Management
        Permission::create(['name' => 'access-request.grant']);        // Grant access
        Permission::create(['name' => 'access-request.reject']);       // Reject access
        Permission::create(['name' => 'access-request.revoke']);       // Revoke access
        Permission::create(['name' => 'access-request.modify']);       // Modify existing access

        // Access Request Comments
        Permission::create(['name' => 'access-request.comment.add']);  // Add comments
        Permission::create(['name' => 'access-request.comment.view']); // View comments

        // System Management
        Permission::create(['name' => 'system.view']);                 // View systems
        Permission::create(['name' => 'system.create']);               // Create new system
        Permission::create(['name' => 'system.edit']);                 // Edit system
        Permission::create(['name' => 'system.delete']);               // Delete system

        // System Access Types
        Permission::create(['name' => 'system.access.view']);          // View access types
        Permission::create(['name' => 'system.access.create']);        // Create access types
        Permission::create(['name' => 'system.access.edit']);          // Edit access types
        Permission::create(['name' => 'system.access.delete']);        // Delete access types

        // Reports and Export
        Permission::create(['name' => 'access-request.export']);       // Export access requests
        Permission::create(['name' => 'access-request.report.view']);  // View reports

        // Add these permissions
        Permission::create(['name' => 'section-head.deramalog']);
        Permission::create(['name' => 'section-head.permit']);
        Permission::create(['name' => 'section-head.gem']);

        // Create roles and assign permissions
        $this->createRoles();
    }

    private function createRoles()
    {
        // Super Admin Role
        $superAdmin = Role::create(['name' => 'super-admin', 'guard_name' => 'web']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin Role
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'web']);
        $admin->givePermissionTo([
            'dashboard.view',
            'dashboard.analytics',
            'ticket.view.any',
            'ticket.edit',
            'ticket.assign',
            'ticket.update.status',
            'ticket.comment',
            'access-request.view.any',
            'access-request.edit',
            'access-request.grant',
            'access-request.reject',
            'access-request.revoke',
            'access-request.modify'
        ]);

        // Manager Role
        $manager = Role::create(['name' => 'manager', 'guard_name' => 'web']);
        $manager->givePermissionTo([
            'dashboard.view',
            'ticket.view.any',
            'ticket.assign',
            'ticket.update.status',
            'ticket.comment',
            'access-request.view.any',
            'access-request.grant',
            'access-request.reject'
        ]);

        // User Role
        $user = Role::create(['name' => 'user', 'guard_name' => 'web']);
        $user->givePermissionTo([
            'dashboard.view',
            'ticket.view.own',
            'ticket.create',
            'ticket.comment',
            'access-request.view.own',
            'access-request.create'
        ]);

        // Section Head Role
        $sectionHead = Role::create(['name' => 'section-head', 'guard_name' => 'web']);
        $sectionHead->givePermissionTo([
            'access-request.view.any',
            'access-request.grant',
            'access-request.reject'
        ]);
    }
}
