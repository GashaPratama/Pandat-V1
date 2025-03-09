<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\JenisSenjataController;
use App\Http\Controllers\SenjataController;



Route::apiResource('gudang', GudangController::class);
Route::apiResource('jenissenjata', JenisSenjataController::class);
Route::apiResource('senjata', SenjataController::class);
