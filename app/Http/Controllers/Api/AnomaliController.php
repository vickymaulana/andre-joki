<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Warga;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class AnomaliController extends Controller
{
    public function index(): JsonResponse
    {
        $wargaLebihDuaKali = DB::table('penerima_bantuan')
            ->join('warga', 'warga.id', '=', 'penerima_bantuan.warga_id')
            ->select([
                'warga.id',
                'warga.nik',
                'warga.nama',
                DB::raw('EXTRACT(YEAR FROM penerima_bantuan.tanggal_terima) as tahun'),
                DB::raw('COUNT(DISTINCT penerima_bantuan.program_id) as total_program'),
            ])
            ->groupBy('warga.id', 'warga.nik', 'warga.nama', DB::raw('EXTRACT(YEAR FROM penerima_bantuan.tanggal_terima)'))
            ->havingRaw('COUNT(DISTINCT penerima_bantuan.program_id) > 2')
            ->get();

        $nikDuplikat = Warga::query()
            ->select('nik', DB::raw('COUNT(*) as total'))
            ->groupBy('nik')
            ->havingRaw('COUNT(*) > 1')
            ->get();

        return response()->json([
            'warga_lebih_dari_2_program_per_tahun' => $wargaLebihDuaKali,
            'nik_duplikat' => $nikDuplikat,
        ]);
    }
}
