<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Kecamatan Sukamaju' => ['Desa Mekarjaya', 'Desa Sukaluyu', 'Desa Cibogo'],
            'Kecamatan Cendana' => ['Desa Cendana Barat', 'Desa Cendana Timur', 'Desa Harapan'],
            'Kecamatan Puspa' => ['Desa Puspa Indah', 'Desa Melati', 'Desa Kenanga'],
        ];

        foreach ($data as $namaKecamatan => $desaList) {
            $kecamatan = Kecamatan::query()->create(['nama_kecamatan' => $namaKecamatan]);

            foreach ($desaList as $namaDesa) {
                $kecamatan->desa()->create(['nama_desa' => $namaDesa]);
            }
        }
    }
}
