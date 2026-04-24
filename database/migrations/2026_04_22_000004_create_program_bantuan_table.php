<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('program_bantuan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_program');
            $table->year('tahun');
            $table->unsignedInteger('kuota');
            $table->timestamps();

            $table->index(['tahun', 'nama_program']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program_bantuan');
    }
};
