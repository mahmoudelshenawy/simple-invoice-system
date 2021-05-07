<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsTableSeeder extends Seeder
{
    // here is the game of two options
    // super admin==> has every permissions
    // admin ==> attach any permission to it

    // option two
    // create Administrator and all Permissions separatly
    // create sub Role Models ==> PurchaseAdmin / SalesAdmin / InvoicesAdmin / CatalogAdmin
    // permissions(Domain)('Purchase','Sales','Invoices','Catalog')
    //   Role::create(['name' => 'PurchaseAdmin']);
    /* 
    $permissions = Permission::where('domain' , 'Purchase')->pluck('id')->get();
    $role->syncPermissions($permissions);
    $user->assignRole([$role->id]);

    two array
    Array_one = [PurchaseAdmin / SalesAdmin / InvoicesAdmin / CatalogAdmin]
    Array_two = ['Purchase','Sales','Invoices','Catalog']
    foreach(Array_one as one){
        Role::create(['name' => 'one']);
    }
    foreach(Array_two as two){
         $permissions = Permission::where('domain' , two)->pluck('id')->get();
         $role = Role::where('name', two . 'Admin')->first();
         $role->syncPermissions($permissions);
    }

    */
    public function run()
    {
        $roles = ['PurchaseAdmin', 'SalesAdmin', 'InvoicesAdmin', 'CatalogAdmin'];
        $domains = [
            "Purchases",
            "Sales",
            "Clients",
            "Invoices",
            "Catalog",
            "Users",
            "Notifications",
            "Reports"
        ];

        $main_role =  Role::create(['name' => 'Administrator']);
        $permissions = Permission::pluck('id', 'id')->all();
        $main_role->syncPermissions($permissions);
        foreach ($domains as $value) {
            $permission = Permission::where('domain', $value)->pluck('id');
            $role = Role::create(['name' => $value . 'Admin']);
            $role->syncPermissions($permission);
        }
    }
}
