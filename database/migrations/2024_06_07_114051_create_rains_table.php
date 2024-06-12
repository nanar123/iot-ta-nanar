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
        // Cek jika tabel sudah ada sebelum membuatnya
        if (!Schema::hasTable('rains')) {
            Schema::create('rains', function (Blueprint $table) {
                $table->id();
                $table->integer('value');
                $table->string('weather')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel 'rains' saat rollback
        Schema::dropIfExists('rains');
    }
};
