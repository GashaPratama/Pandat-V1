<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GudangController;
use App\Http\Controllers\API\JenisSenjataController;
use App\Http\Controllers\API\SenjataController;
use App\Http\Controllers\Api\KaryawanGudangController;
use App\Http\Controllers\API\DetailPengirimanController;





Route::apiResource('gudang', GudangController::class);
Route::apiResource('jenissenjata', JenisSenjataController::class);
Route::apiResource('senjata', SenjataController::class);
Route::apiResource('karyawangudang', KaryawanGudangController::class);
Route::apiResource('institusi', InstitusiController::class);
Route::apiResource('/detail-pengiriman', DetailPengirimanController::class);
Route::apiResource('/detail-pengiriman', DetailPengirimanController::class);

// Route::group([], function () {
//     Route::get('gudang', [GudangController::class, 'listCategory']);
// });
