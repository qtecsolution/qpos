<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Create random categories
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->word(),
            ]);
        }

        // Create random brands
        for ($i = 0; $i < 10; $i++) {
            Brand::create([
                'name' => $faker->company(),
            ]);
        }

        // Create random products
        for ($i = 0; $i < 50; $i++) {
            Product::create([
                'image' => '',
                'name' => $faker->name(),
                'slug' => $faker->slug(),
                'sku' => $faker->unique()->uuid(),
                'description' => $faker->paragraph(),
                'category_id' => Category::inRandomOrder()->first()->id,
                'brand_id' => Brand::inRandomOrder()->first()->id,
                'unit_id' => Unit::inRandomOrder()->first()->id,
                'price' => $faker->numberBetween(101, 1000),
                'discount' => $faker->numberBetween(0, 100),
                'discount_type' => $faker->randomElement(['fixed', 'percentage']),
                'purchase_price' => $faker->numberBetween(1, 900),
                'quantity' => 0,
                'expire_date' => $faker->dateTimeBetween('now', '+1 year'),
                'status' => $faker->boolean() ? 1 : 0,
            ]);
        }
    }
}
