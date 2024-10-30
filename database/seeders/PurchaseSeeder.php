<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Retrieve random suppliers and users
            $suppliers = Supplier::all();
            $users = User::all();

            for ($i = 0; $i < 10; $i++) {
                // Create a new purchase with random supplier and user
                $purchase = Purchase::create([
                    'supplier_id' => $suppliers->random()->id,
                    'user_id' => $users->random()->id,
                    'sub_total' => 0, // To be updated after items are added
                    'tax' => rand(5, 15), // Random tax
                    'discount_value' => rand(0, 50), // Random discount
                    'discount_type' => 'fixed',
                    'shipping' => rand(10, 30), // Random shipping cost
                    'grand_total' => 0, // To be calculated
                    'status' => 1,
                    'date' => now()
                ]);

                $subTotal = 0;

                // Add items to purchase
                for ($j = 0; $j < rand(1, 5); $j++) {
                    $product = Product::inRandomOrder()->first();
                    $purchasePrice = $product->purchase_price;
                    $quantity = rand(1, 10);

                    // Create a purchase item
                    PurchaseItem::create([
                        'purchase_id' => $purchase->id,
                        'product_id' => $product->id,
                        'purchase_price' => $purchasePrice,
                        'price' => $product->price,
                        'quantity' => $quantity
                    ]);

                    // Calculate sub total
                    $subTotal += $purchasePrice * $quantity;

                    // Update product quantity in the products table
                    $product->increment('quantity', $quantity);
                }

                // Update the sub_total and grand_total of the purchase
                $taxAmount = $subTotal * ($purchase->tax / 100);
                $discountAmount = $purchase->discount_type === 'fixed'
                    ? $purchase->discount_value
                    : $subTotal * ($purchase->discount_value / 100);

                $grandTotal = $subTotal + $taxAmount + $purchase->shipping - $discountAmount;

                $purchase->update([
                    'sub_total' => $subTotal,
                    'grand_total' => $grandTotal
                ]);
            }
        });
    }
}
