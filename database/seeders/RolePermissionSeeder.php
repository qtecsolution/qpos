<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds_
     */
    public function run(): void
    {
        $roles = [
            'Admin',
            'cashier',
            'sales_associate',
        ];
        for ($i = 0; $i < count($roles); $i++) {
            $result = Role::firstOrCreate(['name' => $roles[$i]]);
        }
        //creates permission
        $permissions = [
            //dashboard
            'dashboard_view',
            //customer
            'customer_create',
            'customer_view',
            'customer_update',
            'customer_delete',
            //supplier
            'supplier_create',
            'supplier_view',
            'supplier_update',
            'supplier_delete',
            //product
            'product_create',
            'product_view',
            'product_update',
            'product_delete',
            //brand
            'brand_create',
            'brand_view',
            'brand_update',
            'brand_delete',
            //category
            'category_create',
            'category_view',
            'category_update',
            'category_delete',
            //unit
            'unit_create',
            'unit_view',
            'unit_update',
            'unit_delete',
            //sale
            'sale_create',
            'sale_view',
            'sale_update',
            'sale_delete',
            //purchase
            'purchase_create',
            'purchase_view',
            'purchase_update',
            'purchase_delete',
            //reports
            'reports_summery',
            'reports_sales',
            'reports_inventory',
            //currency
            'currency_create',
            'currency_view',
            'currency_update',
            'currency_delete',
            'currency_set-default',
            //role
            'role_create',
            'role_view',
            'role_update',
            'role_delete',
            //user
            'user_create',
            'user_view',
            'user_update',
            'user_delete',
            'user_suspend',

            //setting

        ];
        $admin = Role::where('name', 'Admin')->first();
        for ($i = 0; $i < count($permissions); $i++) {
            $permission = Permission::firstOrCreate(['name' => $permissions[$i]]);
            $admin->givePermissionTo($permission);
            $permission->assignRole($admin);
        }
        $data['name'] = "Mr Admin";
        $data['email'] = "admin@gmail_com";
        $data['password'] = bcrypt(12345678);
        $data['username'] = uniqid();
        $user = User::updateOrCreate(['email' => $data['email']], $data);

        $user->assignRole($admin);
    }
}
