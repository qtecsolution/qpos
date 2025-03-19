<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use App\Models\Setting;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StartUpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'Mr Admin',
            'email' => 'demo@qtecsolution.net',
            'password' => bcrypt(87654321),
            'username' => uniqid()
        ]);
        Customer::create([
            'name' => "Walking Customer",
            'phone' => "012345678",
        ]);
        Supplier::create([
            'name' => "Own Supplier",
            'phone' => "012345678",
        ]);
        $role = Role::create(['name' => 'Admin']);
        $user->syncRoles($role);
        $this->call([
            UnitSeeder::class,
            CurrencySeeder::class,
            RolePermissionSeeder::class,
        ]);
    }
}
