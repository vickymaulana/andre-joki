<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('desa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desa');
            $table->foreignId('kecamatan_id')->constrained('kecamatan')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();

            $table->index(['kecamatan_id', 'nama_desa']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('desa');
    }
};
