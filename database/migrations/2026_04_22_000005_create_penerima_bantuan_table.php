<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('penerima_bantuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained('warga')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('program_id')->constrained('program_bantuan')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('tanggal_terima');
            $table->enum('status_verifikasi', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();

            $table->unique(['warga_id', 'program_id']);
            $table->index(['status_verifikasi', 'tanggal_terima']);
            $table->index(['warga_id', 'tanggal_terima']);
        });

        DB::statement('CREATE INDEX penerima_warga_tahun_idx ON penerima_bantuan (warga_id, EXTRACT(YEAR FROM tanggal_terima));');
    }

    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS penerima_warga_tahun_idx;');
        Schema::dropIfExists('penerima_bantuan');
    }
};
