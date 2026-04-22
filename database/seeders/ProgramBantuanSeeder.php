<?php

namespace Database\Seeders;

use App\Models\ProgramBantuan;
use Illuminate\Database\Seeder;

class ProgramBantuanSeeder extends Seeder
{
    public function run(): void
    {
        $programs = [
            ['nama_program' => 'Bantuan Pangan', 'tahun' => 2025, 'kuota' => 100],
            ['nama_program' => 'Bantuan Pendidikan', 'tahun' => 2025, 'kuota' => 75],
            ['nama_program' => 'Bantuan Kesehatan', 'tahun' => 2026, 'kuota' => 60],
        ];

        foreach ($programs as $program) {
            ProgramBantuan::query()->create($program);
        }
    }
}
