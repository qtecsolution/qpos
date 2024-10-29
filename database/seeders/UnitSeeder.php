<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            [
                'title' => 'Piece',
                'short_name' => 'pcs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kilogram',
                'short_name' => 'kg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Liter',
                'short_name' => 'L',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Meter',
                'short_name' => 'm',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dozen',
                'short_name' => 'dz',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Box',
                'short_name' => 'box',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        Unit::insert($units);
    }
}
