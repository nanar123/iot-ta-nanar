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
        Schema::create('buzzers', function (Blueprint $table) {
            $table->id();
            $table->boolean('value')->default(0); // Nilai 0 menunjukkan mati, 1 menunjukkan hidup
            $table->string('status')->default('aman'); // Status awalnya aman, akan berubah menjadi bahaya jika value adalah 1
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buzzers');
    }
};
