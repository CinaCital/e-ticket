<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');
Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

//login sebelum akses 
Route::middleware('auth')->group(function () {
//rute penerbangan index
Route::get('penerbangan',
[App\Http\Controllers\PenerbanganController::class, 'index'])->name('penerbangan.index')->middleware('admin','maskapai');
//rute penerbangan create
Route::get('penerbangan/create',
[App\Http\Controllers\PenerbanganController::class, 'create'])->name('penerbangan.create')->middleware('admin','maskapai');
//rute penerbangan store
Route::post('penerbangan',
[App\Http\Controllers\PenerbanganController::class, 'store'])->name('penerbangan.store')->middleware('admin','maskapai');
//rute penerbangan edit 
Route::get('penerbangan/{id}/edit',
[App\Http\Controllers\PenerbanganController::class, 'edit'])->name('penerbangan.edit')->middleware('admin','maskapai');
//rute penerbangan update
Route::put('penerbangan/{id}',
[App\Http\Controllers\PenerbanganController::class, 'update'])->name('penerbangan.update')->middleware('admin','maskapai');
//rute penerbangan delete
Route::get('penerbangan/{id}',
[App\Http\Controllers\PenerbanganController::class, 'destroy'])->name('penerbangan.destroy')->middleware('admin','maskapai');

// route transaksi index
Route::get('transaksi',
[App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index')->middleware('admin', 'maskapai');
Route::get('transaksi/create',
[App\Http\Controllers\TransaksiController::class, 'create'])->name('transaksi.create')->middleware('admin','maskapai');
Route::post('transaksi/store',
[App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store')->middleware('admin','maskapai');
Route::get('transaksi/edit/{id}', 
[App\Http\Controllers\TransaksiController::class, 'edit'])->name('transaksi.edit')->middleware('admin','maskapai');
Route::get('transaksi/destroy/{id}',
[App\Http\Controllers\TransaksiController::class, 'destroy'])->name('transaksi.destroy')->middleware('admin','maskapai');
Route::put('transaksi/update/{id}', 
[App\Http\Controllers\TransaksiController::class, 'update'])->name('transaksi.update')->middleware('admin','maskapai');

//checkout 
Route::post('checkout-store',
[App\Http\Controllers\TransaksiController::class, 'checkout_store'])->name('transaksi.checkout_store');
Route::get('checkout',
[App\Http\Controllers\TransaksiController::class, 'checkout'])->name('transaksi.checkout');
Route::get('riwayat-transaksi',
[App\Http\Controllers\TransaksiController::class,'riwayati'])->name('riwayati');
//user-control
Route::get('user-account',
[App\Http\Controllers\HomeController::class,'show'])->name('user.index')->middleware('admin','maskapai');
Route::get('user/edit/{id}', 
[App\Http\Controllers\HomeController::class, 'edit'])->name('user.edit')->middleware('admin','maskapai');
Route::put('user/{id}',
[App\Http\Controllers\HomeController::class, 'update'])->name('user.update')->middleware('admin','maskapai');
Route::get('user/destroy/{id}',
[App\Http\Controllers\HomeController::class, 'destroy'])->name('user.destroy')->middleware('admin','maskapai');

});
