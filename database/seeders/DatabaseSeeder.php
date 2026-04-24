<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KecamatanSeeder::class,
            WargaSeeder::class,
            ProgramBantuanSeeder::class,
            PenerimaBantuanSeeder::class,
        ]);
    }
}
