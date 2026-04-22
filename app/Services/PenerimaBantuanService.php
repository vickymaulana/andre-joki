<?php

namespace App\Services;

use App\Models\PenerimaBantuan;
use App\Models\ProgramBantuan;
use Illuminate\Validation\ValidationException;

class PenerimaBantuanService
{
    public function create(array $data): PenerimaBantuan
    {
        $program = ProgramBantuan::query()->findOrFail($data['program_id']);
        $tahun = (int) date('Y', strtotime($data['tanggal_terima']));

        if ((int) $program->tahun !== $tahun) {
            throw ValidationException::withMessages([
                'tanggal_terima' => ['Tahun pada tanggal_terima harus sama dengan tahun program bantuan.'],
            ]);
        }

        $sudahTerdaftar = PenerimaBantuan::query()
            ->where('warga_id', $data['warga_id'])
            ->where('program_id', $data['program_id'])
            ->exists();

        if ($sudahTerdaftar) {
            throw ValidationException::withMessages([
                'program_id' => ['Warga sudah terdaftar pada program bantuan ini.'],
            ]);
        }

        $totalProgramPerTahun = PenerimaBantuan::query()
            ->where('warga_id', $data['warga_id'])
            ->whereYear('tanggal_terima', $tahun)
            ->distinct('program_id')
            ->count('program_id');

        if ($totalProgramPerTahun >= 2) {
            throw ValidationException::withMessages([
                'warga_id' => ['1 warga maksimal menerima 2 program dalam 1 tahun.'],
            ]);
        }

        return PenerimaBantuan::query()->create($data);
    }
}
