<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use App\Models\Setting;
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
            'email' => 'admin@gmail.com',
            'password' => bcrypt(12345678),
            'username' => uniqid()
        ]);

        $role = Role::create(['name' => 'Admin']);
        $user->syncRoles($role);
        Customer::create([
            'name' => "Walking Customer",
            'phone' => "012345678",
        ]);
    }
}
