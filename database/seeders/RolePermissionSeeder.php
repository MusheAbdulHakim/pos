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
            'view-product-categories','create-product-category','edit-product-category','destroy-product-category',
            'view-units','create-unit','edit-unit','destroy-unit',
            'view-taxes','create-tax','edit-tax','destroy-tax',
            'view-brands','create-brand','edit-brand','destroy-brand','view-settings',
            'view-products','create-product','edit-product','destroy-product',
            'view-purchases','create-purchase','edit-purchase','destroy-purchase',
            'view-sales','create-sale','edit-sale','destroy-sale','view-pos',
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
