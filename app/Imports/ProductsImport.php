<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ProductsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Find or create brand, category, and unit
        $brand = Brand::firstOrCreate(['name' => $row['brand']]);
        $category = Category::firstOrCreate(['name' => $row['category']]);
        $unit = Unit::firstOrCreate(
            ['title' => $row['unit']],
            ['short_name' => $row['unit']]
        );


        $sku = $row['sku'];
        $originalSku = $sku;
        $counter = 1;
        // Check for SKU uniqueness
        while (Product::where('sku', $sku)->exists()) {
            // Append a counter to the original SKU to make it unique
            $sku = $originalSku . '-' . $counter;
            $counter++;
        }
        // Create the product
        $product = Product::create([
            'name' => $row['name'],
            'sku' => $sku,
            'description' => $row['description'],
            'category_id' => $category->id,
            'brand_id' => $brand->id,
            'unit_id' => $unit->id,
            'price' => $row['price'],
            'discount' => $row['discount'],
            'discount_type' => $row['discount_type'],
            'purchase_price' => $row['purchase_price'],
            'quantity' => $row['quantity'],
            'expire_date' => $row['expire_date'],
            'status' => $row['status']
        ]);

        // Create purchase record
        $purchase = Purchase::create([
            'supplier_id' => 1,
            'user_id' => Auth::id(),
            'sub_total' => $row['purchase_price'] * $row['quantity'],
            'tax' => 0,
            'discount' =>0,
            'discount_type' => 0,
            'shipping' => 0,
            'grand_total' => $row['purchase_price'] * $row['quantity'],
            'status' => 1,
            'date' => now()
        ]);

        // Create purchase item record
        PurchaseItem::create([
            'purchase_id' => $purchase->id,
            'product_id' => $product->id,
            'purchase_price' => $row['purchase_price'],
            'price' => $row['price'],
            'quantity' => $row['quantity'],
        ]);
    }
}
