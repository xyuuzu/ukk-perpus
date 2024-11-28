<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\UlasanController;
use Illuminate\Support\Facades\Route;

Route::controller(DashboardController::class)->middleware('auth')->group(function () {
    Route::get('/dashboard', 'dashboard')->name('admin');
    Route::get('/dashboard/user', 'userTable')->name('user.table');
    Route::get('/dashboard/user/create', 'userCreate')->name('user.create');
    Route::post('/dashboard/user', 'userStore')->name('user.store');
    Route::get('/dashboard/user/{id}/edit', 'userEdit')->name('user.edit');
    Route::patch('/dashboard/user/{id}/edit', 'userUpdate')->name('user.update');
    Route::delete('/dashboard/user/{id}', 'userDelete')->name('user.delete');
});


Route::controller(BukuController::class)->group(function () {
    Route::get('/buku', 'index')->name('buku.index');
    Route::get('/buku/create', 'create')->name('buku.create');
    Route::post('/buku', 'store')->name('buku.store');
    Route::get('/buku/{bukus}', 'show')->name('buku.show');
    Route::get('/buku/{buku}/edit', 'edit')->name('buku.edit');
    Route::patch('/buku/{buku}/edit', 'update')->name('buku.update');
    Route::delete('/buku/{buku}', 'destroy')->name('buku.destroy');
});

Route::controller(KategoriController::class)->group(function () {
    Route::get('/kategori', 'index')->name('kategori.index');
    Route::get('/kategori/create', 'create')->name('kategori.create');
    Route::post('/kategori', 'store')->name('kategori.store');
    Route::get('/kategori/{kategori}', 'show')->name('kategori.show');
    Route::get('/kategori/{kategori}/edit', 'edit')->name('kategori.edit');
    Route::patch('/kategori/{kategori}/edit', 'update')->name('kategori.update');
    Route::delete('/kategori/{kategori}', 'destroy')->name('kategori.destroy');
});

Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/list', 'list_book')->name('list-buku');
    Route::get('/detail/{id}', 'detail_buku')->name('detail-buku');
    Route::get('/anda', 'bukuAnda')->name('buku-anda');
    Route::get('/info-pengembalian', 'infoPengembalian')->name('info-pengembalian');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'regisForm')->name('register.form');
    Route::post('/register', 'register')->name('register');
    Route::get('/login', 'loginForm')->name('login.form');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(PeminjamanController::class)->group(function () {
    Route::get('/permintaan', 'listPermintaan')->name('list-permintaan');
    Route::get('/peminjaman', 'listPeminjaman')->name('list-peminjaman');
    Route::post('/pinjam-buku/{id}', 'pinjamBuku')->name('pinjam-buku');
    Route::post('/terima-peminjaman/{id}',  'terimaPeminjaman')->name('terima-peminjaman');
    Route::post('/tolak-peminjaman/{id}', 'tolakPeminjaman')->name('tolak-peminjaman');
    Route::get('/manual-peminjaman/create', 'formmanualCreate')->name('manual-peminjaman');
    Route::post('/manual-peminjaman', 'manualCreate')->name('store-manual-peminjaman');
});



Route::controller(PengembalianController::class)->group(function () {
    Route::get('/pengembalian/data', 'index')->name('pengembalian.index');
    Route::get('/pengembalian/create/{id}', 'create')->name('pengembalian.create');
    Route::post('/pengembalian/manual','store')->name('pengembalian.store'); 
    Route::get('/pengembalian/manual', 'manual')->name('pengembalian.manual');
});

Route::controller(UlasanController::class)->group(function () {
    Route::post('/ulasan/{buku}', 'storeUlasan')->name('ulasans.store');
});

Route::controller(KoleksiController::class)->group(function () {
    Route::get('/koleksi', 'index')->name('koleksi.index');
    Route::post('/koleksi/toggle/{buku_id}', 'toggleKoleksi')->name('koleksi.toggle');
});

Route::controller(LaporanController::class)->group(function () {
    Route::get('/laporan/pengembalian', 'pengembalian')->name('laporan.pengembalian');
    Route::get('/laporan/peminjaman', 'peminjaman')->name('laporan.peminjaman');
});

