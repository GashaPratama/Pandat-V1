<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\GudangController;
use App\Http\Controllers\API\JenisSenjataController;
use App\Http\Controllers\API\SenjataController;



Route::apiResource('gudang', GudangController::class);
Route::apiResource('jenissenjata', JenisSenjataController::class);
Route::apiResource('senjata', SenjataController::class);

// Route::group([], function () {
//     Route::get('gudang', [GudangController::class, 'listCategory']);
// });
