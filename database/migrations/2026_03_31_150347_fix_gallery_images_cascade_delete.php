<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. DROP foreign key lama
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropForeign(['gallery_id']);
        });
        
        // 2. BUAT ULANG foreign key TANPA cascade
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->foreign('gallery_id')
                  ->references('id')
                  ->on('galleries')
                  ->restrict();  // ❌ TIDAK HAPUS gallery otomatis
        });
    }

    public function down(): void
    {
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->dropForeign(['gallery_id']);
        });
        
        Schema::table('gallery_images', function (Blueprint $table) {
            $table->foreign('gallery_id')
                  ->references('id')
                  ->on('galleries')
                  ->cascadeOnDelete();  // Kembalikan cascade
        });
    }
};