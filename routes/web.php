<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\PesananController;



// rute ke manajeman barang
Route::get('/kamera', [BarangController::class, 'indexKamera'])->name('kamera.index');
Route::get('/atribut', [BarangController::class, 'indexAtribut'])->name('atribut.index');
Route::post('/formBarang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::get('/formBarang', function () {
    return view('formBarang' , ['title' => 'Form Data Barang' ,]);
});


// rute pelanggan
Route::get('/', [BarangController::class, 'publicWelcome'])->name('welcome');
Route::get('/beranda', [AuthController::class, 'beranda'])->name('beranda');
// Register pengguna
Route::post('/register', [AuthController::class, 'register'])->name('register');
// Login pengguna
Route::post('/login', [AuthController::class, 'login'])->name('login');
// Logout pengguna
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// rute ke tiga menu katalog di beranda
Route::get('/katalogSemua', [BarangController::class, 'katalogSemua'])->name('katalog.semua');
Route::get('/katalogKamera', [BarangController::class, 'katalogKamera'])->name('katalog.kamera');
Route::get('/katalogAtribut', [BarangController::class, 'katalogAtribut'])->name('katalog.atribut');


// rute ke login admin dan dashboar
Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::get('/loginAdmin', function () {
    return view('loginAdmin' , ['title' => 'Login Admin' ,]);
})->name('loginAdmin');

Route::get('/dashboard', [BarangController::class, 'dashboard'])->name('dashboard');
Route::post('/logout-admin', [AuthController::class, 'logoutAdmin'])->name('admin.logout');


// rute menu pengguna dan pelanggan di side nav admin
Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
Route::get('/ulasan', [UlasanController::class, 'index'])->name('ulasan.index');
Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
Route::get('/admin', [AuthController::class, 'adminIndex'])->name('admin.index');
Route::post('/admin', [AuthController::class, 'adminStore'])->name('admin.store');
Route::delete('/admin/{id}', [AuthController::class, 'adminDestroy'])->name('admin.destroy');




// rute ke menu transaksi di side nav admin
Route::get('/riwayat', [PesananController::class, 'riwayat'])->name('pesanan.riwayat')->name('pesanan.riwayat');

Route::get('/pesanan/{id}', [PesananController::class, 'show'])->name('pesanan.show');

Route::get('/sewaAktif', [PesananController::class, 'aktif'])->name('pesanan.aktif');

Route::get('/daftarPesanan', [PesananController::class, 'index'])->name('pesanan.index');
Route::get('/semua', [PesananController::class, 'semua'])->name('pesanan.semua');



Route::post('/keranjang/store', [KeranjangController::class, 'store'])->name('keranjang.store');
// view keranjang
Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang.index');
    Route::get('/keranjang/create', [KeranjangController::class, 'create'])->name('keranjang.create');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
});

// ulasan
Route::post('/ulasan/simpan', [UlasanController::class, 'simpan'])->name('ulasan.simpan');
// hapus ulasan
Route::delete('/ulasan/hapus/{id_ulasan}', [UlasanController::class, 'hapusUlasan'])->name('ulasan.hapus');
Route::get('/ulasan/{id}', [UlasanController::class, 'show'])->name('ulasan.show');
Route::delete('/ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');

Route::middleware(['auth:pelanggan'])->group(function () {
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store'); // <-- penting
});

Route::patch('/pesanan/{id}/konfirmasi', [PesananController::class, 'konfirmasi'])->name('pesanan.konfirmasi');
Route::patch('/pesanan/{id}/selesai', [PesananController::class, 'selesai'])->name('pesanan.selesai');
Route::get('/profil', [PelangganController::class, 'profilSaya'])->name('profil.pelanggan')->middleware('auth:pelanggan');
Route::delete('/pesanan/{id}/tolak', [PesananController::class, 'tolak'])->name('pesanan.tolak');
Route::delete('/pesanan/{id}/batalkan', [PesananController::class, 'batalkan'])->name('pesanan.batalkan');
Route::post('/midtrans/callback', [PesananController::class, 'callback'])->name('midtrans.callback');