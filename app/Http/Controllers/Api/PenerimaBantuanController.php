<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenerimaBantuanRequest;
use App\Models\PenerimaBantuan;
use App\Services\PenerimaBantuanService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PenerimaBantuanController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = PenerimaBantuan::query()
            ->with([
                'warga.desa.kecamatan',
                'program',
            ]);

        if ($request->filled('tahun')) {
            $query->whereHas('program', function ($q) use ($request) {
                $q->where('tahun', $request->integer('tahun'));
            });
        }

        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->string('status'));
        }

        $penerima = $query->get()->map(function (PenerimaBantuan $item) {
            return [
                'nama_warga' => $item->warga->nama,
                'desa' => $item->warga->desa->nama_desa,
                'kecamatan' => $item->warga->desa->kecamatan->nama_kecamatan,
                'program_bantuan' => $item->program->nama_program,
                'status_verifikasi' => $item->status_verifikasi,
            ];
        });

        return response()->json($penerima);
    }

    public function store(StorePenerimaBantuanRequest $request, PenerimaBantuanService $service): JsonResponse
    {
        $penerima = $service->create($request->validated());

        return response()->json([
            'message' => 'Penerima bantuan berhasil ditambahkan.',
            'data' => $penerima,
        ], 201);
    }
}
