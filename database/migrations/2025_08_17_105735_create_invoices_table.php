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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   // رقم الفاتورة من MyFatoorah
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('EGP');
            $table->enum('status', ['Pending', 'Paid', 'Failed'])->default('Pending');
            // Pending, Paid, Failed
            $table->string('invoice_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
