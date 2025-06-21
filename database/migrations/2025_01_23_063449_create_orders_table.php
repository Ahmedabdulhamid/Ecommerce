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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('countary_id')->nullable();
            $table->unsignedInteger('governorate_id')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->string('street')->nullable();
            $table->decimal('shipping_price')->nullable();
            $table->decimal('total_price')->nullable();
            $table->text('notes')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->enum('status',['pending','completed','canceld','delivered'])->default('pending');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('countary_id')->references('id')->on('countaries')->onDelete('cascade');
            $table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
