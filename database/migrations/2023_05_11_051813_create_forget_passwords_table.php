<?php

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
        Schema::create('forget_passwords', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->string('email')->nullable();
            $table->integer('otp')->nullable();
            $table->smallInteger('failed_attempt')->default(0);
            $table->string('token')->nullable();
            $table->string('suspend_duration')->default(0);
            $table->smallInteger('resent_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forget_passwords');
    }
};
