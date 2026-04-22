<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kecamatan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function perKecamatan(): JsonResponse
    {
        $laporan = Kecamatan::query()
            ->leftJoin('desa', 'desa.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('warga', 'warga.desa_id', '=', 'desa.id')
            ->leftJoin('penerima_bantuan', 'penerima_bantuan.warga_id', '=', 'warga.id')
            ->select([
                'kecamatan.id',
                'kecamatan.nama_kecamatan',
                DB::raw('COUNT(DISTINCT warga.id) as jumlah_warga'),
                DB::raw('COUNT(DISTINCT penerima_bantuan.warga_id) as jumlah_penerima_bantuan'),
            ])
            ->groupBy('kecamatan.id', 'kecamatan.nama_kecamatan')
            ->get()
            ->map(function ($item) {
                $persentase = $item->jumlah_warga > 0
                    ? round(($item->jumlah_penerima_bantuan / $item->jumlah_warga) * 100, 2)
                    : 0;

                return [
                    'nama_kecamatan' => $item->nama_kecamatan,
                    'jumlah_penerima_bantuan' => (int) $item->jumlah_penerima_bantuan,
                    'jumlah_warga' => (int) $item->jumlah_warga,
                    'persentase_penerima_bantuan' => $persentase,
                ];
            });

        return response()->json($laporan);
    }
}
