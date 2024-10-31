<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class DemoProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return collect(
            [
                [
                    'name' => 'Product A',
                    'sku' => 'PROD001',
                    'description' => 'This is a description for Product A.',
                    'category' => 'Electronics',
                    'brand' => 'Brand X',
                    'unit' => 'piece',
                    'price' => 200.00,
                    'discount' => 20.00,
                    'discount_type' => 'fixed',
                    'purchase_price' => 150.00,
                    'quantity' => 100,
                    'expire_date' => '2024-12-31',
                    'status' => '1'
                ],
                [
                    'name' => 'Product B',
                    'sku' => 'PROD002',
                    'description' => 'This is a description for Product B.',
                    'category' => 'Home Appliances',
                    'brand' => 'Brand Y',
                    'unit' => 'piece',
                    'price' => 300.00,
                    'discount' => 10,
                    'discount_type' => 'percentage',
                    'purchase_price' => 250.00,
                    'quantity' => 50,
                    'expire_date' => '2025-06-30',
                    'status' => '1'
                ],
                [
                    'name' => 'Product C',
                    'sku' => 'PROD003',
                    'description' => 'This is a description for Product C.',
                    'category' => 'Furniture',
                    'brand' => 'Brand Z',
                    'unit' => 'set',
                    'price' => 500.00,
                    'discount' => 50.00,
                    'discount_type' => 'fixed',
                    'purchase_price' => 400.00,
                    'quantity' => 30,
                    'expire_date' => '2025-12-31',
                    'status' => '0'
                ],
                [
                    'name' => 'Product D',
                    'sku' => 'PROD004',
                    'description' => 'This is a description for Product D.',
                    'category' => 'Groceries',
                    'brand' => 'Brand A',
                    'unit' => 'kg',
                    'price' => 50.00,
                    'discount' => 5.00,
                    'discount_type' => 'fixed',
                    'purchase_price' => 40.00,
                    'quantity' => 200,
                    'expire_date' => '2024-11-30',
                    'status' => '1'
                ],
                [
                    'name' => 'Product E',
                    'sku' => 'PROD005',
                    'description' => 'This is a description for Product E.',
                    'category' => 'Toys',
                    'brand' => 'Brand B',
                    'unit' => 'piece',
                    'price' => 120.00,
                    'discount' => 15,
                    'discount_type' => 'percentage',
                    'purchase_price' => 90.00,
                    'quantity' => 150,
                    'expire_date' => '2025-03-31',
                    'status' => '1'
                ]
            ]
        );
    }

    public function headings(): array
    {
        return ['name', 'sku', 'description', 'category', 'brand', 'unit', 'price', 'discount', 'discount_type', 'purchase_price', 'quantity', 'expire_date', 'status'];
    }
}
