<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\{
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

Route::apiResource('detailpengiriman', DetailPengirimanController::class);
Route::apiResource('gudang', GudangController::class);
Route::apiResource('institusi', InstitusiController::class);
Route::apiResource('jenissenjata', JenisSenjataController::class);
Route::apiResource('karyawangudang', KaryawanGudangController::class);
Route::apiResource('lisensisenjata', LisensiSenjataController::class);
Route::apiResource('pengirimansenjata', PengirimanSenjataController::class);
Route::apiResource('perawatansenjata', PerawatanSenjataController::class);
Route::apiResource('senjata', SenjataController::class);

// Route::group([], function () {
//     Route::get('gudang', [GudangController::class, 'listCategory']);
// });
