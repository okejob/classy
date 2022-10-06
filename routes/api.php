<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//outlet
Route::post('/setting/outlet', [OutletController::class, 'APIinsert']);
Route::post('/setting/outlet/{id}', [OutletController::class, 'APIupdate']);
Route::get('/setting/outlet/delete/{id}', [OutletController::class, 'APIdelete']);

//jenis_item
Route::post('/data/jenis-item', [JenisItemController::class, 'APIinsert']);
Route::post('/data/jenis-item/{id}', [JenisItemController::class, 'APIupdate']);
Route::get('/data/jenis-item/delete/{id}', [JenisItemController::class, 'APIdelete']);

//pengeluaran
Route::post('/data/pengeluaran', [PengeluaranController::class, 'APIinsert']);
Route::post('/data/pengeluaran/{id}', [PengeluaranController::class, 'APIupdate']);
Route::get('/data/pengeluaran/delete/{id}', [PengeluaranController::class, 'APIdelete']);

//parfum
Route::post('/data/parfum', [ParfumController::class, 'APIinsert']);
Route::post('/data/parfum/{id}', [ParfumController::class, 'APIupdate']);
Route::get('/data/parfum/delete/{id}', [ParfumController::class, 'APIdelete']);

//pelanggan
Route::post('/data/pelanggan', [PelangganController::class, 'APIinsert']);
Route::post('/data/pelanggan/{id}', [PelangganController::class, 'APIupdate']);
Route::get('/data/pelanggan/delete/{id}', [PelangganController::class, 'APIdelete']);
