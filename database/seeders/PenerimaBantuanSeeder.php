<?php

namespace Database\Seeders;

use App\Models\PenerimaBantuan;
use App\Models\ProgramBantuan;
use App\Models\Warga;
use Illuminate\Database\Seeder;

class PenerimaBantuanSeeder extends Seeder
{
    public function run(): void
    {
        $wargaIds = Warga::query()->pluck('id');
        $programs = ProgramBantuan::query()->get();

        foreach ($wargaIds as $wargaId) {
            $jumlahProgram = random_int(0, 2);
            $programTerpilih = $programs->shuffle()->take($jumlahProgram);

            foreach ($programTerpilih as $program) {
                PenerimaBantuan::query()->create([
                    'warga_id' => $wargaId,
                    'program_id' => $program->id,
                    'tanggal_terima' => sprintf('%d-%02d-%02d', $program->tahun, random_int(1, 12), random_int(1, 28)),
                    'status_verifikasi' => collect(['pending', 'verified', 'rejected'])->random(),
                ]);
            }
        }
    }
}
