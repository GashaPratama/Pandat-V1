<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\JenisSenjataController;



Route::apiResource('gudang', GudangController::class);
Route::apiResource('jenissenjata', JenisSenjataController::class);
