<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'))->name('home');

Route::get('/buku', [BukuController::class, 'index'])
    ->name('buku.index');

    Route::get('/buku/create', [BukuController::class, 'index'])
    ->middleware(['auth', 'can:kelola-buku'])
    ->name('buku.create');

Route::get('/buku/{id}', [BukuController::class, 'show'])
    ->name('buku.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {

// A2: Pencarian buku dengan query binding
Route::get('/buku-cari', [BukuController::class, 'cariRentan'])
    ->middleware('auth')
    ->name('buku.cari');

    // Perbaikan A3 (Soal 2c): Route GET /buku/{buku}/hapus dihapus, diganti menjadi DELETE /buku/{buku}
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
        ->name('buku.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware(['role:admin|petugas', 'permission:akses dashboard admin|akses dashboard petugas']);

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index')
        ->middleware('permission:lihat laporan perpustakaan');

    Route::get('/profil', [ProfileController::class, 'edit'])
        ->name('profile.edit')
        ->middleware('permission:lihat profil sendiri');

    Route::patch('/profil', [ProfileController::class, 'update'])
        ->name('profile.update')
        ->middleware('permission:ubah profil sendiri');

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index')
        ->middleware('permission:melihat riwayat peminjaman sendiri|kelola peminjaman');

    // A4: IDOR (Akan diperbaiki pada Soal 4)
    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])
        ->name('peminjaman.show');

    Route::post('/peminjaman', [PeminjamanController::class, 'store'])
        ->name('peminjaman.store')
        ->middleware('permission:mengajukan peminjaman buku');

    Route::patch('/peminjaman/{peminjaman}/setujui', [PeminjamanController::class, 'approve'])
        ->name('peminjaman.approve')
        ->middleware('permission:memproses persetujuan peminjaman');

    Route::patch('/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'returnBook'])
        ->name('peminjaman.return')
        ->middleware('permission:mencatat pengembalian buku');

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        // Menampilkan daftar pengguna
        Route::get('/pengguna', [UserController::class, 'index'])
            ->name('users.index')
            ->middleware('permission:kelola data pengguna');

        // Menambahkan akun pengguna baru
        Route::post('/pengguna', [UserController::class, 'store'])
            ->name('users.store')
            ->middleware('permission:kelola data pengguna');

        // Mengubah role pengguna
        Route::patch('/pengguna/{user}/role', [UserController::class, 'updateRole'])
            ->name('users.role')
            ->middleware('permission:kelola role pengguna');

        // Menghapus pengguna
        Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy')
            ->middleware('permission:kelola data pengguna');
    });
});