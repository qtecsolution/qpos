<?php

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Customer::class)->constrained()->cascadeOnDelete();
            $table->double('discount')->default(0);
            $table->double('sub_total')->default(0)->comment('sumOf(total) from order_products table');
            $table->double('total')->default(0)->comment('sub_total - discount');
            $table->double('paid')->default(0)->comment('customer paid amount');
            $table->double('due')->default(0)->comment('total - paid');
            $table->text('note')->nullable();
            $table->boolean('is_returned')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
