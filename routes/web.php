<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ParfumController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\UserController;
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
    return view('welcome');
})->name('welcome');

Route::get('/login', [PageController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/reset-password', [PageController::class, 'resetPassword'])->name('reset_password');

    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/data/item', [PageController::class, 'item'])->name('data-item')->middleware('permission:menu_item');
    Route::get('/data/kategori', [PageController::class, 'kategori'])->name('data-kategori')->middleware('permission:menu_kategori');
    Route::get('/data/pengeluaran', [PageController::class, 'pengeluaran'])->name('data-pengeluaran')->middleware('permission:menu_pengeluaran');
    Route::get('/data/rewash', [PageController::class, 'rewash'])->name('data-rewash')->middleware('permission:menu_rewash');

    //Setting
    Route::get('/setting/karyawan', [PageController::class, 'karyawan'])->name('setting-karyawan')->middleware('permission:setting_karyawan');
    Route::get('/setting/outlet', [PageController::class, 'outlet'])->name('setting-outlet')->middleware('permission:setting_outlet');
    Route::get('/setting/paket', [PageController::class, 'paket'])->name('setting-paket')->middleware('permission:setting_paket');

    //parfum
    Route::get('/data/parfum', [PageController::class, 'parfum'])->name('data-parfum')->middleware('permission:menu_parfum');
    Route::post('/data/parfum', [ParfumController::class, 'insert'])->middleware('permission:insert_parfum');
    Route::get('data/parfum/delete/{id}', [ParfumController::class, 'delete'])->middleware('permission:delete_parfum');
    //Pelanggan
    Route::get('/data/pelanggan', [PageController::class, 'item'])->name('data-pelanggan')->middleware('permission:menu_pelanggan');
    Route::post('/data/pelanggan', [PelangganController::class, 'insert'])->middleware('permission:insert_pelanggan');
    Route::get('/data/pelanggan/delete/{id}', [PelangganController::class, 'delete'])->middleware('permission:delete_pelanggan');
});
