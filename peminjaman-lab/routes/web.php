<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role?->nama;
        if (strtolower($role) === 'mahasiswa') {
            return redirect()->route('mahasiswa.dashboard');
        }
        return redirect()->route('barang.index');
    }
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk pendaftaran mahasiswa (diakses tanpa login)
    Route::get('/register-mahasiswa', [AuthController::class, 'register'])->name('register');
    Route::post('/register-mahasiswa', [AuthController::class, 'storeRegister'])->name('register.store');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Semua role admin bisa akses transaksi
    Route::resource('transaksi', TransaksiController::class);
    Route::post('transaksi/{id}/approve', [TransaksiController::class, 'approve'])->name('transaksi.approve');
    Route::post('transaksi/{id}/tolak', [TransaksiController::class, 'tolak'])->name('transaksi.tolak');
    Route::post('transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])->name('transaksi.kembalikan');

    // Aslab & Kalab bisa akses barang & peminjam
    Route::middleware('role:aslab,kalab')->group(function () {
        Route::resource('barang', BarangController::class);
        Route::resource('peminjam', PeminjamController::class);
    });

    // Hanya Kalab yang bisa kelola user
    Route::middleware('role:kalab')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Routes untuk mahasiswa
    Route::middleware('role:mahasiswa')->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Mahasiswa\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/barang', [\App\Http\Controllers\Mahasiswa\RequestPeminjamanController::class, 'index'])->name('barang');
        Route::post('/request', [\App\Http\Controllers\Mahasiswa\RequestPeminjamanController::class, 'store'])->name('request');
        Route::get('/riwayat', [\App\Http\Controllers\Mahasiswa\RequestPeminjamanController::class, 'riwayat'])->name('riwayat');
    });
});

require __DIR__.'/auth.php';
