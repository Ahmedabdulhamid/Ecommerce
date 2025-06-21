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
       Schema::table('orders', function (Blueprint $table) {
            // حذف الفوريجن كي قبل حذف الأعمدة

            $table->dropForeign(['countary_id']);
            $table->dropForeign(['governorate_id']);

            // حذف الأعمدة نفسها
            $table->dropColumn(['city_id', 'countary_id', 'governorate_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('countary_id')->nullable();
            $table->unsignedInteger('governorate_id')->nullable();



            $table->foreign('countary_id')->references('id')->on('countaries')->onDelete('cascade');
            $table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('cascade');
        });
        });
    }
};
