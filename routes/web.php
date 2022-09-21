<?php

use App\Http\Controllers\PageController;
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
Route::get('/reset-password', [PageController::class, 'resetPassword'])->name('reset_password')->middleware('auth');
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/data/item', [PageController::class, 'item'])->name('data-item');
    Route::get('/data/kategori', [PageController::class, 'kategori'])->name('data-kategori');
    Route::get('/data/parfum', [PageController::class, 'parfum'])->name('data-parfum');
    Route::get('/data/pelanggan', [PageController::class, 'item'])->name('data-pelanggan');
    Route::get('/data/pengeluaran', [PageController::class, 'pengeluaran'])->name('data-pengeluaran');
    Route::get('/data/rewash', [PageController::class, 'rewash'])->name('data-rewash');
});
