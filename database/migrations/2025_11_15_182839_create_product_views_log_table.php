<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_views_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('ip_address')->nullable();
            $table->timestamps(); // Ini akan membuat created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_views_log');
    }
};