<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DetailProdukController;





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

Route::get('/', [PenjualController::class, 'login'])->name('login');
Route::post('/login', [PenjualController::class, 'auth'])->name('login.auth');
Route::get('/logout', [PenjualController::class, 'logout'])->name('logaut');
Route::get('/penjualan/export/PDF/{id}', [PenjualController::class, 'exportPDF'])->name('export.PDF');
Route::get('/export/Excel/', [PenjualController::class, 'exportExcel'])->name('export.Excel');



Route::middleware('islogin','CekRole:admin')->group(function(){
Route::get('/user', [PenjualController::class, 'user'])->name('user');
Route::get('/register', [PenjualController::class, 'register'])->name('register');
Route::post('/register', [PenjualController::class, 'inputRegister'])->name('register.post');
Route::delete('/hapuss/{id}', [PenjualController::class, 'destroy'])->name('hapus');
Route::get('/editt/{id}', [PenjualController::class, 'edit'])->name('editt');
Route::patch('/ubahh/{id}', [PenjualController::class, 'update'])->name('ubahh');
Route::get('/dashboard', [PenjualController::class, 'dashboard'])->name('admin');
Route::get('/pembelian', [PenjualController::class, 'pembelian'])->name('pembelian');
Route::get('/user', [PenjualController::class, 'user'])->name('user');
Route::get('/produk', [ProdukController::class, 'produk'])->name('produk');
Route::Post('/produk', [ProdukController::class, 'store'])->name('store.produk');
Route::delete('/hapus/{id}', [ProdukController::class, 'destroy'])->name('delete');
Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('edit');
Route::get('/updatestok/{id}', [ProdukController::class, 'updatestok'])->name('updatestok');
Route::patch('/stokupdate/{id}', [ProdukController::class, 'stokupdate'])->name('stokupdate');
Route::patch('/ubah/{id}', [ProdukController::class, 'update'])->name('ubah');
Route::get('/produk/search',[ProdukController::class, 'search'])->name('produk.search');

});

Route::middleware('islogin','CekRole:petugas')->group(function(){
Route::get('/dashboardA', [PenjualController::class, 'dashboardA'])->name('petugas');
Route::get('/pembelianA', [PenjualController::class, 'pembelianA'])->name('pembelianA');
Route::get('/show/{id}', [PenjualController::class, 'show'])->name('show');
Route::get('/bon-pembelian/{id}', [PenjualController::class, 'showbon'])->name('bon-pembelian');
Route::get('/create/pembelian', [PenjualController::class, 'create'])->name('create-pembelian');
Route::post('/create/pembelian', [PenjualController::class, 'store'])->name('store-pembelian');
Route::get('/produkA', [ProdukController::class, 'produkA'])->name('produkA');
Route::delete('/penjualan/{id}', [PelangganController::class, 'destroy'])->name('penjualan.destroy');
Route::get('/penjualan/invoice/{id}', [PenjualController::class, 'invoice'])->name('invoice.penjualan');
Route::patch('/penjualan/invoice/{id}/store', [PenjualController::class, 'invoiceStore'])->name('invoice.store');


});