<?php

use App\Models\Supplier;
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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Supplier::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->double('sub_total', 10, 2)->default(0);
            $table->double('tax', 10, 2)->default(0);
            $table->double('discount_value', 10, 2)->default(0);
            $table->string('discount_type')->default('fixed');
            $table->double('shipping', 10, 2)->default(0);
            $table->double('grand_total', 10, 2)->default(0);
            $table->tinyInteger('status');
            $table->timestamp('date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
