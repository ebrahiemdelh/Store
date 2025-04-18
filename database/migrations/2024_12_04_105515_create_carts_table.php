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
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cookies_id');
            $table->foreignId('user_id')->nullable()->constrained('users','id')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products','id')->cascadeOnDelete();
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->json('options')->nullable();
            $table->timestamps();

            $table->unique(['cookies_id', 'product_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
