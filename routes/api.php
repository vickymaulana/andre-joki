<?php

use App\Http\Controllers\Api\AnomaliController;
use App\Http\Controllers\Api\LaporanController;
use App\Http\Controllers\Api\PenerimaBantuanController;
use Illuminate\Support\Facades\Route;

Route::get('/penerima', [PenerimaBantuanController::class, 'index']);
Route::post('/penerima', [PenerimaBantuanController::class, 'store']);
Route::get('/laporan/kecamatan', [LaporanController::class, 'perKecamatan']);
Route::get('/anomali', [AnomaliController::class, 'index']);
