<?php

use Illuminate\Support\Facades\Route;

// Tampilkan halaman login
Route::view('/login', 'login')->name('login');

// Tampilkan halaman register
Route::view('/register', 'register')->name('register');

// Halaman setelah login sukses (misalnya dashboard)
Route::get('/dashboard', function () {
    return view('dashboard'); // pastikan kamu buat file dashboard.blade.php
})->name('dashboard');

// Optional: Logout frontend (hapus token di client-side via JavaScript)
Route::get('/logout', function () {
    return redirect('/login'); // Logout hanya frontend, token masih aktif kecuali dihapus via API
});
