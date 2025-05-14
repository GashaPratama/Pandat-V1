<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GudangController;
use App\Http\Controllers\API\JenisSenjataController;
use App\Http\Controllers\API\SenjataController;
use App\Http\Controllers\Api\KaryawanGudangController;




Route::apiResource('gudang', GudangController::class);
Route::apiResource('jenissenjata', JenisSenjataController::class);
Route::apiResource('senjata', SenjataController::class);
Route::apiResource('karyawangudang', KaryawanGudangController::class);
Route::apiResource('institusi', InstitusiController::class);

// Route::group([], function () {
//     Route::get('gudang', [GudangController::class, 'listCategory']);
// });
