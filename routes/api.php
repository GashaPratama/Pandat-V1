<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GudangController;


Route::get('/gudang', [GudangController::class, 'index']);
Route::post('/gudang', [GudangController::class, 'store']);
Route::get('/gudang/{id}', [GudangController::class, 'show']);
Route::put('/gudang/{id}', [GudangController::class, 'update']);
Route::delete('/gudang/{id}', [GudangController::class, 'destroy']);