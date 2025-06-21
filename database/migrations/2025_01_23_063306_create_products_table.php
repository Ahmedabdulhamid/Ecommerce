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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('brand_id')->nullable();
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->text('small_desc')->nullable();
            $table->longText('desc')->nullable();
            $table->boolean('status')->default(1);
            $table->string('sku')->nullable();
            $table->date('available_for')->nullable();
            $table->boolean('has_variants')->default(0);
            $table->integer('views')->default(0);
            $table->decimal('price',8,3)->nullable();
            $table->boolean('has_discount')->default(0);
            $table->decimal('discount')->nullable();
            $table->dateTime('start_discount_date')->nullable();
            $table->dateTime('end_discount_date')->nullable();
            $table->boolean('manage_stock')->default(0);
            $table->integer('quantity')->nullable();
            $table->boolean('available_in_stock')->default(1);
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
