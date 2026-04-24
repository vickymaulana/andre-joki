<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('warga', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama');
            $table->text('alamat');
            $table->foreignId('desa_id')->constrained('desa')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();

            $table->index(['desa_id', 'nama']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};
