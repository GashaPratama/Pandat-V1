<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\{
    DetailPengirimanController,
    GudangController,
    InstitusiController,
    JenisSenjataController,
    KaryawanGudangController,
    LisensiSenjataController,
    PengirimanSenjataController,
    PerawatanSenjataController,
    SenjataController
};

Route::apiResource('detail-pengiriman', DetailPengirimanController::class);
Route::apiResource('gudang', GudangController::class);
Route::apiResource('institusi', InstitusiController::class);
Route::apiResource('jenissenjata', JenisSenjataController::class);
Route::apiResource('karyawan-gudang', KaryawanGudangController::class);
Route::apiResource('lisensi', LisensiSenjataController::class);
Route::apiResource('pengiriman', PengirimanSenjataController::class);
Route::apiResource('perawatan', PerawatanSenjataController::class);
Route::apiResource('senjata', SenjataController::class);

// Route::group([], function () {
//     Route::get('gudang', [GudangController::class, 'listCategory']);
// });
