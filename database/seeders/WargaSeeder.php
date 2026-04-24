<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Warga;
use Illuminate\Database\Seeder;

class WargaSeeder extends Seeder
{
    public function run(): void
    {
        $desaIds = Desa::query()->pluck('id');

        for ($i = 1; $i <= 20; $i++) {
            Warga::query()->create([
                'nik' => str_pad((string) random_int(1, 9999999999999999), 16, '0', STR_PAD_LEFT),
                'nama' => 'Warga ' . $i,
                'alamat' => 'Jl. Contoh No. ' . random_int(1, 200),
                'desa_id' => $desaIds->random(),
            ]);
        }
    }
}
