<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            Supplier::create([
                'name' => $faker->name(),
                'phone' => $faker->unique()->phoneNumber(),
                'address' => $faker->address(),
            ]);
        }
    }
}
