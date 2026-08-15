<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Default Breeze: Kalau ada yang nyasar ke /dashboard, tendang ke home
Route::get('/dashboard', function () {
    return redirect('/');
})->name('dashboard');

// Halaman Utama (Bisa diakses Guest & User)
// (Pastikan lu punya HomeController, atau ganti balik ke function return view('home') kalau curhatannya murni diproses di halaman yang sama)
Route::get('/', function () {
    return view('home'); // Asumsi halaman utamanya lu kasih nama home.blade.php
})->name('home');

// Nangkep form submit curhatan (Publik dengan Throttle)
Route::post('/diary', [App\Http\Controllers\DiaryController::class, 'store'])->name('diary.store')->middleware('throttle:2,1');

// KANDANG AUTH: Cuma bisa diakses kalau user udah login
Route::middleware(['auth', 'verified'])->group(function () {

    // Rute Profil
    // Route::get('/profil', function () {
    //     return view('profile');
    // })->name('profile');

    // RUTE RIWAYAT: HARUS DIARAHKAN KE CONTROLLER BIAR DATANYA KETARIK!
    Route::get('/riwayat', [App\Http\Controllers\DiaryController::class, 'history'])->name('history');

});

// === RUTE BAWAAN BREEZE (Jangan Dihapus) ===
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
