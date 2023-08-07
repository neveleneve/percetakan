<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login'));
});
Auth::routes([
    'register' => false,
    'reset' => false,
]);

Route::get('/dashboard',     [App\Http\Controllers\HomeController::class, 'index'])
    ->name('dashboard');

Route::resource('user', App\Http\Controllers\UserController::class);
Route::resource('gudang', App\Http\Controllers\GudangController::class);
Route::resource('item', App\Http\Controllers\ItemController::class);
Route::resource('transaksi/masuk', App\Http\Controllers\TrxMasukController::class)->except([
    'show',
    'edit',
    'update',
    'destroy',
]);
Route::resource('transaksi/keluar', App\Http\Controllers\TrxKeluarController::class)->except([
    'show',
    'edit',
    'update',
    'destroy',
]);
Route::resource('transaksi', App\Http\Controllers\TrxController::class)->except([
    'create',
    'store',
    'update',
    'edit',
]);

Route::get('laporan/item', [App\Http\Controllers\LaporanController::class, 'laporanDaftarBarang'])->name('laporan.barang');
Route::get('laporan/gudang', [App\Http\Controllers\LaporanController::class, 'laporanDaftarGudang'])->name('laporan.gudang');
Route::get('laporan/transaksi/masuk', [App\Http\Controllers\LaporanController::class, 'laporanBarangMasuk'])->name('laporan.masuk');
Route::get('laporan/transaksi/keluar', [App\Http\Controllers\LaporanController::class, 'laporanBarangKeluar'])->name('laporan.keluar');

Route::post('laporan/cetak', [App\Http\Controllers\LaporanController::class, 'cetak'])->name('laporan.cetak');
