<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('quantity');
            $table->double('price');
            $table->double('discount_amount');
            $table->foreignUuid('customer_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('coupon_applied')->default(false);
            $table->string('coupon_code')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
