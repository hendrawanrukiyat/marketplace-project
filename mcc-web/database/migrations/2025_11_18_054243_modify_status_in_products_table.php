<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Modifikasi kolom status untuk menambahkan 'pending'
            $table->enum('status', ['published', 'draft', 'pending'])->default('draft')->change();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Ini akan mengembalikan ke kondisi semula jika di-rollback
            $table->enum('status', ['published', 'draft'])->default('draft')->change();
        });
    }
};