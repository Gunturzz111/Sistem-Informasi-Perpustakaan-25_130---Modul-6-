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

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/buku/{id}', [BukuController::class, 'show'])->whereNumber('id')->name('buku.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Operasi CRUD buku hanya untuk admin dan petugas melalui Gate kelola-buku.
    Route::middleware('can:kelola-buku')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'index'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->whereNumber('id')->name('buku.edit');
        Route::put('/buku/{id}', [BukuController::class, 'update'])->whereNumber('id')->name('buku.update');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->whereNumber('id')->name('buku.destroy');
    });

    Route::get('/buku-cari', [BukuController::class, 'cariRentan'])->name('buku.cari');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware(['role:admin|petugas', 'permission:akses dashboard admin|akses dashboard petugas']);

    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index')->middleware('permission:lihat laporan perpustakaan');

    Route::get('/profil', [ProfileController::class, 'edit'])
        ->name('profile.edit')->middleware('permission:lihat profil sendiri');

    Route::patch('/profil', [ProfileController::class, 'update'])
        ->name('profile.update')->middleware('permission:ubah profil sendiri');

    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index')
        ->middleware('permission:melihat riwayat peminjaman sendiri|kelola peminjaman');

    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])
        ->whereNumber('id')->name('peminjaman.show');

    Route::post('/peminjaman', [PeminjamanController::class, 'store'])
        ->name('peminjaman.store')->middleware('permission:mengajukan peminjaman buku');

    Route::patch('/peminjaman/{peminjaman}/setujui', [PeminjamanController::class, 'approve'])
        ->name('peminjaman.approve')->middleware('permission:memproses persetujuan peminjaman');

    Route::patch('/peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'returnBook'])
        ->name('peminjaman.return')->middleware('permission:mencatat pengembalian buku');

    Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
        Route::get('/pengguna', [UserController::class, 'index'])->name('users.index')->middleware('permission:kelola data pengguna');
        Route::post('/pengguna', [UserController::class, 'store'])->name('users.store')->middleware('permission:kelola data pengguna');
        Route::patch('/pengguna/{user}/role', [UserController::class, 'updateRole'])->name('users.role')->middleware('permission:kelola role pengguna');
        Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:kelola data pengguna');
    });
});
