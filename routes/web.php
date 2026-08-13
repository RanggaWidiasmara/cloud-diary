<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// KANDANG AUTH: Cuma bisa diakses kalau user udah login
Route::middleware(['auth', 'verified'])->group(function () {

    // Breeze default-nya ngelempar ke /dashboard abis login.
    // Kita belokin otomatis ke rute / (home) lu.
    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    // Rute ini WAJIB ada ->name('home') di ujungnya
    Route::get('/', function () {
        return view('home');
    })->name('home');

    // Rute ini WAJIB ada ->name('profile')
    Route::get('/profil', function () {
        return view('profile');
    })->name('profile');

    // Rute ini WAJIB ada ->name('history')
    Route::get('/riwayat', function () {
        return view('history');
    })->name('history');

});

// === RUTE BAWAAN BREEZE (Jangan Dihapus) ===
// Ini buat logic ganti password dan hapus akun di backend
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute buat nangkep submit curhatan
Route::post('/diary', [App\Http\Controllers\DiaryController::class, 'store'])->name('diary.store');

require __DIR__.'/auth.php';
