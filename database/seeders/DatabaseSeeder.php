<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            StartUpSeeder::class,
           // Please comment out the following seeders when running in production for the client
            ProductSeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
            PurchaseSeeder::class,
        ]);
    }
}
