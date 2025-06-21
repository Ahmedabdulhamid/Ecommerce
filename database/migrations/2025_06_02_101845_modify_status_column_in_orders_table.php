<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::getConnection()->getDoctrineSchemaManager()
    ->getDatabasePlatform()
    ->registerDoctrineTypeMapping('enum', 'string');

       Schema::table('orders', function (Blueprint $table) {
    $table->string('status')->default('pending')->change();
});
    }

    public function down(): void
    {
       Schema::table('orders', function (Blueprint $table) {
    $table->string('status')->default('pending')->change();
});
    }
};
