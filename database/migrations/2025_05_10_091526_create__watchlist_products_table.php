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
        Schema::create('_watchlist_products', function (Blueprint $table) {
            $table->id();
             $table->unsignedInteger('product_id')->nullable();
             $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
             $table->unsignedInteger('watchlist_id')->nullable();
             $table->foreign('watchlist_id')->references('id')->on('wishlists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_watchlist_products');
    }
};
