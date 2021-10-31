<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $arrayOfPermissionNames = [
            'view-expense-categories','create-expense-category','edit-expense-category','destroy-expense-category',
            'view-expenses','create-expense','edit-expense','destroy-expense',
            'view-people','view-customer-types','create-customer-type','edit-customer-type','destroy-customer-type',
            'view-customers','create-customer','edit-customer','destroy-customer',
            'view-suppliers','create-supplier','edit-supplier','destroy-supplier',
            'view-backups','create-backup','download-backup','destroy-backup',
            'view-authentication',
            'view-users','create-user','edit-user','destroy-user',
            'view-roles','create-role','edit-role','destroy-role',
            'view-permissions','create-permission','edit-permission','destroy-permission',
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });
    
        Permission::insert($permissions->toArray());
        
        $admin = Role::create(['name' => 'super-admin']);
        $admin->givePermissionTo(Permission::all());
    }
}
