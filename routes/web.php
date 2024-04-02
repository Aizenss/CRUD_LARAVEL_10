<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', function () {
    return view('beranda');
})->middleware(['auth', 'verified'])->name('beranda');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(KategoriController::class)->group(function () {
    Route::get('/kategori', 'index')->middleware(['auth', 'verified'])->name('kategori');
    Route::post('/kategori', [KategoriController::class, 'store'])->middleware(['auth', 'verified'])->name('kategori.store');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->middleware(['auth', 'verified'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->middleware(['auth', 'verified'])->name('kategori.destroy');
});

Route::controller(SupplierController::class)->group(function () {
    Route::get('/supplier', 'index')->middleware(['auth', 'verified'])->name('supplier');
    Route::post('/supplier', [SupplierController::class, 'store'])->middleware(['auth', 'verified'])->name('supplier.store');
    Route::put('/supplier/{id}', [SupplierController::class, 'update'])->middleware(['auth', 'verified'])->name('supplier.update');
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->middleware(['auth', 'verified'])->name('supplier.destroy');
});

Route::controller(PengurusController::class)->group(function () {
    Route::get('/pengurus', 'index')->middleware(['auth', 'verified'])->name('pengurus');
    Route::post('/pengurus', [PengurusController::class, 'store'])->middleware(['auth', 'verified'])->name('pengurus.store');
    Route::put('/pengurus/{id}', [PengurusController::class, 'update'])->middleware(['auth', 'verified'])->name('pengurus.update');
    Route::delete('/pengurus/{id}', [PengurusController::class, 'destroy'])->middleware(['auth', 'verified'])->name('pengurus.destroy');
});

Route::controller(TransaksiController::class)->group(function () {
    Route::get('/transaksi', 'index')->middleware(['auth', 'verified'])->name('transaksi');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->middleware(['auth', 'verified'])->name('transaksi.store');
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update'])->middleware(['auth', 'verified'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->middleware(['auth', 'verified'])->name('transaksi.destroy');
});

Route::controller(ProdukController::class)->group(function () {
    Route::get('/produk', 'index')->middleware(['auth', 'verified'])->name('produk');
    Route::post('/produk', [ProdukController::class, 'store'])->middleware(['auth', 'verified'])->name('produk.store');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->middleware(['auth', 'verified'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->middleware(['auth', 'verified'])->name('produk.destroy');
});

Route::controller(LaporanController::class)->group(function () {
    Route::get('/laporan', 'index')->middleware(['auth', 'verified'])->name('laporan');
    Route::post('/laporan', [LaporanController::class, 'store'])->middleware(['auth', 'verified'])->name('laporan.store');
    Route::put('/laporan/{id}', [LaporanController::class, 'update'])->middleware(['auth', 'verified'])->name('laporan.update');
    Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->middleware(['auth', 'verified'])->name('laporan.destroy');
});

require __DIR__ . '/auth.php';