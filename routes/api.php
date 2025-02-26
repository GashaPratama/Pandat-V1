<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\JenisSenjataController;
use App\Http\Controllers\SenjataController;

Route::apiResource('gudang', GudangController::class);
Route::apiResource('jenis_senjata', JenisSenjataController::class);
Route::apiResource('senjata', SenjataController::class);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

