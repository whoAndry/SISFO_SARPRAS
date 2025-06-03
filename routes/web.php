<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanBarangController;
use App\Http\Controllers\LaporanPeminjamanController;
use App\Http\Controllers\LaporanPengembalianController;
use App\Http\Controllers\PenggunaController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home page
Route::get('/', function () {
    return view('login');
});

// Auth - Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('actionregister');

// Auth - Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('actionlogin');

// Auth - Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', [DashboardController::class, 'index'])->name('home');

Route::resource('kategori_barang', App\Http\Controllers\KategoriBarangController::class);

Route::resource('data_barang', App\Http\Controllers\DataBarangController::class);

// routes/web.php
// Route::resource('peminjamans', PeminjamanController::class);
// Route::post('/peminjamans/{id}/terima', [PeminjamanController::class, 'terima'])->name('peminjamans.terima');
// Route::post('/peminjamans/{id}/tolak', [PeminjamanController::class, 'tolak'])->name('peminjamans.tolak');

// Route::get('/peminjamans', [PeminjamanController::class, 'index'])->name('peminjamans.index');
// Route::post('/peminjamans', [PeminjamanController::class, 'store'])->name('peminjamans.store');

Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::post('/peminjaman/{id}/status/{status}', [PeminjamanController::class, 'updateStatus'])->name('peminjaman.updateStatus');

Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::post('/pengembalian', [PengembalianController::class, 'store']);

Route::get('/laporan-barang', [LaporanBarangController::class, 'index'])->name('laporan.barang');
Route::get('/laporan-barang/pdf', [LaporanBarangController::class, 'exportPdf'])->name('laporan.barang.pdf');

Route::get('/laporan-peminjaman', [LaporanPeminjamanController::class, 'index'])->name('laporan.peminjaman');
Route::get('/laporan-peminjaman/pdf', [LaporanPeminjamanController::class, 'exportPdf'])->name('laporan.peminjaman.pdf');

Route::get('/laporan/pengembalian', [LaporanPengembalianController::class, 'index'])->name('laporan.pengembalian');
Route::get('/laporan/pengembalian/pdf', [LaporanPengembalianController::class, 'exportPdf'])->name('laporan.pengembalian.pdf');

Route::resource('pengguna', PenggunaController::class);





// Protected page - hanya bisa diakses jika sudah login



