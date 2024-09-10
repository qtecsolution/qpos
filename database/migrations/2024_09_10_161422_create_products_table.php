<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('name');
            $table->text('description');
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete();
            $table->double('price')->default(0);
            $table->double('discount')->default(0);
            $table->string('discount_type')->default('fixed');
            $table->double('purchase_price')->default(0);
            $table->integer('quantity')->default(0);
            $table->date('expire_date')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
