<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemNoteController;
use App\Http\Controllers\ItemTransaksiController;
use App\Http\Controllers\JenisItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanInventoryController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PackingController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaketCuciController;
use App\Http\Controllers\PaketDepositController;
use App\Http\Controllers\ParfumController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PickupDeliveryController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\RewashController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DiskonController;
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
    return redirect()->route('login');
})->name('welcome');

Route::get('/print/{id}', [PrintController::class, 'pdf']);
Route::get('/printPreview/{id}', [PrintController::class, 'preview']);

//Middleware Guest digunakan ketika belum login
Route::get('/login', [PageController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/logout', [UserController::class, 'logout']);

//Middleware Auth digunakan ketika Sudah Login
Route::middleware(['auth'])->group(function () {
    Route::get('/reset-password', [PageController::class, 'resetPassword'])->name('reset_password');

    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

    Route::get('/setting/hak-akses/list', [PermissionController::class, 'permissionList']); //Ngambil List SEMUA Permission
    Route::get('/setting/hak-akses/role/{role}', [PermissionController::class, 'rolesPermissionList']); //Ngambil List Permission KHUSUS ROLE Tertentu
    Route::post('/setting/hak-akses/role/{role}/sync', [PermissionController::class, 'syncPermission'])->middleware('permission:Merubah Hak Akses'); //Ngambil List Permission KHUSUS ROLE Tertentu
    //Setting

    //Karyawan
    Route::get('/setting/karyawan', [PageController::class, 'karyawan'])->name('menu-karyawan')->middleware('permission:Membuka Menu Karyawan');
    Route::get('/setting/karyawan/{id}', [UserController::class, 'show'])->middleware('permission:Melihat Detail Karyawan');
    Route::post('/setting/karyawan', [UserController::class, 'insert'])->middleware('permission:Menambahkan Karyawan');
    Route::post('/setting/karyawan/{id}', [UserController::class, 'update'])->middleware('permission:Mengubah Data Karyawan');
    Route::post('/setting/karyawan/{user}/change-password', [UserController::class, 'changePassword'])->middleware('permission:Mengubah Data Password Karyawan');

    //outlet
    Route::get('/setting/outlet', [PageController::class, 'outlet'])->name('menu-outlet')->middleware('permission:Membuka Menu Outlet');
    Route::get('/setting/outlet/{id}', [OutletController::class, 'show'])->middleware('permission:Melihat Detail Outlet');
    Route::post('/setting/outlet', [OutletController::class, 'insert'])->middleware('permission:Membuat Outlet');
    Route::post('/setting/outlet/{id}', [OutletController::class, 'update'])->middleware('permission:Mengubah Data Outlet');
    Route::get('/setting/outlet/delete/{id}', [OutletController::class, 'delete'])->middleware('permission:Menghapus Outlet');
    Route::get('/setting/outlet/update-saldo/{outlet}', [OutletController::class, 'updateSaldo'])->middleware('permission:Menambah Saldo Outlet');

    //Paket Cuci
    Route::get('/setting/paket-cuci', [PageController::class, 'paketCuci'])->name('menu-paket-cuci')->middleware('permission:Membuka Menu Paket Cuci');
    Route::get('/setting/paket-cuci/{id}', [PaketCuciController::class, 'show'])->middleware('permission:Melihat Detail Paket Cuci');
    Route::post('/setting/paket-cuci', [PaketCuciController::class, 'insert'])->middleware('permission:Membuat Paket Cuci');
    Route::post('/setting/paket-cuci/{id}', [PaketCuciController::class, 'update'])->middleware('permission:Mengubah Data Paket Cuci');
    Route::get('/setting/paket-cuci/delete/{id}', [PaketCuciController::class, 'delete'])->middleware('permission:Menghapus Paket Cuci');

    //Paket Deposit
    Route::get('/setting/paket-deposit', [PageController::class, 'paketDeposit'])->name('menu-paket-deposit')->middleware('permission:Membuka Menu Paket Deposit');
    Route::get('/setting/paket-deposit/{id}', [PaketDepositController::class, 'show'])->middleware('permission:Melihat Detail Paket Deposit');
    Route::post('/setting/paket-deposit', [PaketDepositController::class, 'insert'])->middleware('permission:Membuat Paket Deposit');
    Route::post('/setting/paket-deposit/{id}', [PaketDepositController::class, 'update'])->middleware('permission:Mengubah Data Paket Deposit');
    Route::get('/setting/paket-deposit/delete/{id}', [PaketDepositController::class, 'delete'])->middleware('permission:Menghapus Paket Deposit');

    //item
    Route::get('/data/jenis-item', [PageController::class, 'jenisItem'])->name('menu-jenis-item')->middleware('permission:Membuka Menu Jenis Item');
    Route::get('/data/jenis-item/find', [JenisItemController::class, 'find']);
    Route::get('/data/jenis-item/{id}', [JenisItemController::class, 'show'])->middleware('permission:Melihat Detail Jenis Item');
    Route::post('/data/jenis-item', [JenisItemController::class, 'insert'])->middleware('permission:Membuat Jenis Item');
    Route::post('/data/jenis-item/{id}', [JenisItemController::class, 'update'])->middleware('permission:Mengubah Data Jenis Item');
    Route::get('/data/jenis-item/delete/{id}', [JenisItemController::class, 'delete'])->middleware('permission:Menghapus Jenis Item');

    //Kategori
    Route::get('/data/kategori', [PageController::class, 'kategori'])->name('menu-kategori')->middleware('permission:Membuka Menu Kategori');
    Route::get('/data/kategori/{id}', [KategoriController::class, 'show'])->middleware('permission:Melihat Detail Kategori');
    Route::post('/data/kategori', [KategoriController::class, 'insert'])->middleware('permission:Membuat Kategori');
    Route::post('/data/kategori/{id}', [KategoriController::class, 'update'])->middleware('permission:Mengubah Data Kategori');
    Route::get('/data/kategori/delete/{id}', [KategoriController::class, 'delete'])->middleware('permission:Menghapus Kategori');

    //pengeluaran
    Route::get('/data/pengeluaran', [PageController::class, 'pengeluaran'])->name('menu-pengeluaran')->middleware('permission:Membuka Menu Pengeluaran');
    Route::get('/data/pengeluaran/{id}', [PengeluaranController::class, 'show'])->middleware('permission:Melihat Detail Pengeluaran');
    Route::post('/data/pengeluaran', [PengeluaranController::class, 'insert'])->middleware('permission:Membuat Pengeluaran');
    Route::post('/data/pengeluaran/{id}', [PengeluaranController::class, 'update'])->middleware('permission:Mengubah Data Pengeluaran');
    Route::get('/data/pengeluaran/delete/{id}', [PengeluaranController::class, 'delete'])->middleware('permission:Menghapus Pengeluaran');

    //Parfum
    Route::get('/data/parfum', [PageController::class, 'parfum'])->name('menu-parfum')->middleware('permission:Membuka Menu Parfum');
    Route::get('/data/parfum/{id}', [ParfumController::class, 'show'])->middleware('permission:Melihat Detail Parfum');
    Route::post('/data/parfum', [ParfumController::class, 'insert'])->middleware('permission:Membuat Parfum');
    Route::post('/data/parfum/{id}', [ParfumController::class, 'update'])->middleware('permission:Mengubah Data Parfum');
    Route::get('data/parfum/delete/{id}', [ParfumController::class, 'delete'])->middleware('permission:Menghapus Parfum');

    //Pelanggan
    Route::get('/data/pelanggan', [PageController::class, 'pelanggan'])->name('menu-pelanggan')->middleware('permission:Membuka Menu Pelanggan');
    Route::get('/data/pelanggan/{id}', [PelangganController::class, 'show'])->middleware('permission:Membuka Halaman Detail Pelanggan');
    Route::post('/data/pelanggan', [PelangganController::class, 'insert'])->middleware('permission:Membuat Pelanggan');
    Route::post('/data/pelanggan/{id}', [PelangganController::class, 'update'])->middleware('permission:Mengubah Data Pelanggan');
    Route::get('/data/pelanggan/delete/{id}', [PelangganController::class, 'delete'])->middleware('permission:Menghapus Pelanggan');
    Route::get('/component/pelanggan', [PelangganController::class, 'search']);

    //Rewash data
    Route::get('/data/rewash', [PageController::class, 'dataRewash'])->name('data-rewash')->middleware('permission:Membuka Menu Rewash');
    Route::post('/data/rewash', [RewashController::class, 'insertData'])->middleware('permission:Menambah Rewash');
    Route::get('/data/rewash/delete/{id}', [RewashController::class, 'deleteData'])->middleware('permission:Menghapus Rewash');

    // Diskon
    Route::get('/data/diskon', [PageController::class, 'diskon'])->name('data-diskon')->middleware('permission:Membuka Menu Diskon');
    Route::post('/data/diskon', [DiskonController::class, 'insert'])->middleware('permission:Menambah Data Diskon');
    Route::post('/data/diskon/{diskon}', [DiskonController::class, 'update'])->middleware('permission:Mengubah Data Diskon');
    Route::get('/data/diskon/delete/{id}', [DiskonController::class, 'delete'])->middleware('permission:Menghapus Data Diskon');

    //Pickup & Delivery
    Route::get('/transaksi/pickup-delivery', [PageController::class, 'pickupDelivery'])->name('pickup-delivery')->middleware('permission:Membuka Menu Pickup Delivery');
    Route::get('/transaksi/pickup-delivery/{id}', [PickupDeliveryController::class, 'show'])->middleware('permission:Melihat Detail Pickup Delivery');
    Route::post('/transaksi/pickup-delivery', [PickupDeliveryController::class, 'insert'])->middleware('permission:Membuat Pickup Delivery');
    Route::post('/transaksi/pickup-delivery/{id}', [PickupDeliveryController::class, 'update'])->middleware('permission:Mengubah Data Pickup Delivery');
    Route::get('/transaksi/pickup-delivery/delete/{id}', [PickupDeliveryController::class, 'delete'])->middleware('permission:Menghapus Pickup Delivery');
    Route::get('/component/pickup', [PickupDeliveryController::class, 'pickup']);
    Route::get('/component/delivery', [PickupDeliveryController::class, 'delivery']);
    Route::get('/component/ambil_di_outlet', [PickupDeliveryController::class, 'ambil_di_outlet']);
    Route::get('/transaksi/pickup-delivery/task-hub', [PickupDeliveryController::class, 'showTaskHub']);
    Route::get('/transaksi/pickup-delivery/{pickup_delivery}/is-done', [PickupDeliveryController::class, 'changeDoneStatus'])->middleware('permission:Mengganti Status Selesai Pickup Delivery');

    //Catatan Item Transaksi //ItemTransaksi
    Route::get('/transaksi/item-transaksi/{id}', [ItemTransaksiController::class, 'show'])->middleware('permission:Melihat Detail Item Transaksi');
    Route::post('/transaksi/item-transaksi', [ItemTransaksiController::class, 'insert'])->middleware('permission:Membuat Item Transaksi');
    Route::post('/transaksi/item-transaksi/{id}', [ItemTransaksiController::class, 'update'])->middleware('permission:Mengubah Data Item Transaksi');
    Route::post('/transaksi/item-transaksi/{id}/qty', [ItemTransaksiController::class, 'updateQty']);
    Route::get('/transaksi/item-transaksi/delete/{id}', [ItemTransaksiController::class, 'delete'])->middleware('permission:Menghapus Item Transaksi');

    //ItemNote
    Route::get('/transaksi/item/note/list/{item_transaksi_id}', [ItemNoteController::class, 'list'])->middleware('permission:Melihat Detail Daftar Catatan Item');
    Route::get('/transaksi/item/note/{id}', [ItemNoteController::class, 'show'])->middleware('permission:Melihat Detail Catatan Item');
    Route::post('/transaksi/item/note/add', [ItemNoteController::class, 'insert'])->middleware('permission:Membuat Catatan Item');

    //Transaksi
    Route::get('/transaksi', [PageController::class, 'transaksi'])->name('transaksi')->middleware('permission:Membuka Menu Transaksi');
    Route::get('/transaksi/create', [TransaksiController::class, 'insert'])->middleware('permission:Membuat Transaksi');
    Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'show'])->middleware('permission:Melihat Detail Transaksi');
    Route::get('/transaksi/search', [TransaksiController::class, 'search']);
    Route::get('/transaksi/addItem', [ItemTransaksiController::class, 'addItemToTransaksi'])->middleware('permission:Menambahkan Item Ke Transaksi');
    Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update'])->middleware('permission:Mengubah Data Transaksi');
    Route::post('/transaksi/penerima', [PenerimaController::class, 'insert'])->middleware('permission:Menambahkan Penerima Ke Transaksi');
    Route::get('/transaksi/cancelled', [PageController::class, 'cancel']);
    Route::get('/transaksi/{transaksi}/cancel', [TransaksiController::class, 'cancelTransaksi'])->middleware('permission:Membatalkan Transaksi');
    Route::get('/transaksi/{id}/restore', [TransaksiController::class, 'restoreTransaksi'])->middleware('permission:Restore Transaksi');

    // Bucket
    Route::get('/transaksi/bucket', [PageController::class, 'bucket'])->name('transaksi')->middleware('permission:Membuka Menu Transaksi');
    Route::get('/component/transBucket/{id}', [TransaksiController::class, 'tableBucket']);
    // Premium
    Route::get('/transaksi/premium', [PageController::class, 'premium'])->name('transaksi')->middleware('permission:Membuka Menu Transaksi');
    Route::get('/component/transPremium/{id}', [TransaksiController::class, 'tablePremium']);

    // proses cuci & seterika
    Route::get('/proses/cuci', [PageController::class, 'hubCuci'])->middleware('permission:Membuka Menu Hub Cuci');
    Route::get('/proses/setrika', [PageController::class, 'hubSetrika'])->middleware('permission:Membuka Menu Hub Setrika');
    //ganti status pencuci & penyetrika
    Route::get('/transaksi/{transaksi}/pencuci', [TransaksiController::class, 'changeStatusCuci'])->middleware('permission:Mengambil Tugas Cuci');
    Route::get('/transaksi/{transaksi}/penyetrika', [TransaksiController::class, 'changeStatusSetrika'])->middleware('permission:Mengambil Tugas Setrika');
    //hapus status pencuci & penyetrika
    Route::get('/transaksi/{transaksi}/pencuci/delete', [TransaksiController::class, 'clearStatusCuci'])->middleware('permission:Mengurangi Tugas Cuci');
    Route::get('/transaksi/{transaksi}/penyetrika/delete', [TransaksiController::class, 'clearStatusSetrika'])->middleware('permission:Mengurangi Tugas Setrika');
    //Autentikasi Diskon
    Route::post('/transaksi/diskon/autentikasi', [TransaksiController::class, 'authenticationDiskon']);
    Route::get('/transaksi/diskon/special/transaksi/{transaksi}/nominal/{nominal}', [TransaksiController::class, 'inputSpecialDiskon']);

    //History
    Route::get('/data/pelanggan/{id_pelanggan}/detail', [PelangganController::class, 'detailPelanggan'])->middleware('permission:Membuka Halaman Detail Pelanggan');
    Route::get('/pelanggan/{id_pelanggan}/history/transaksi', [TransaksiController::class, 'historyPelanggan'])->middleware('permission:Melihat Detail History Transaksi Pelanggan');
    Route::get('/pelanggan/{id_pelanggan}/history/saldo', [SaldoController::class, 'historyPelanggan'])->middleware('permission:Melihat Detail History Saldo Pelanggan');

    //Saldo
    Route::get('/transaksi/saldo', [PageController::class, 'saldo'])->middleware('permission:Membuka Menu Saldo');
    Route::get('/pelanggan/{pelanggan_id}/check-saldo', [SaldoController::class, 'getSaldo']);
    Route::post('/pelanggan/{pelanggan_id}/add-saldo', [SaldoController::class, 'insert'])->middleware('permission:Topup Saldo Pelanggan');

    //Pembayaran
    Route::get('/transaksi/pembayaran', [PageController::class, 'pembayaran'])->name('menu_pembayaran')->middleware('permission:Membuka Menu Pembayaran');
    Route::get('/transaksi/pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->middleware('permission:Melihat Detail Pembayaran');
    Route::post('/transaksi/pembayaran', [PembayaranController::class, 'insert'])->middleware('permission:Membuat Pembayaran');
    Route::post('/transaksi/pembayaran-tagihan', [PembayaranController::class, 'bayarTagihan'])->middleware('permission:Membuat Pembayaran');
    Route::post('/transaksi/pembayaran/{pembayaran}', [PembayaranController::class, 'update'])->middleware('permission:Mengubah Data Pembayaran');
    Route::get('/transaksi/pembayaran/delete/{pembayaran}', [PembayaranController::class, 'delete'])->middleware('permission:Menghapus Pembayaran');

    //Inventory
    Route::get('/data/inventory', [PageController::class, 'inventory'])->name('menu-inventory')->middleware('permission:Membuka Menu Inventory');
    Route::post('/data/inventory/insert', [InventoryController::class, 'insert'])->middleware('permission:Menambah Inventory');
    Route::post('/data/inventory/update/{inventory}', [InventoryController::class, 'update'])->middleware('permission:Mengubah Data Inventory');
    Route::get('/data/inventory/delete/{inventory}', [InventoryController::class, 'delete'])->middleware('permission:Menghapus Inventory');
    Route::post('/data/inventory/traffic', [LaporanInventoryController::class, 'insert'])->middleware('permission:Mengubah Data Stok Inventory');

    //Rewash proses
    Route::get('/proses/rewash', [PageController::class, 'prosesRewash'])->name('menu-rewash')->middleware('permission:Membuka Menu Proses Rewash');
    Route::post('/proses/rewash/insert', [RewashController::class, 'insert'])->middleware('permission:Menambah Data Proses Rewash');
    Route::post('/proses/rewash/update-status/{rewash}', [RewashController::class, 'updateStatus'])->middleware('permission:Menyatakan Selesai Proses Rewash');
    Route::get('/proses/rewash/delete/{rewash}', [RewashController::class, 'delete'])->middleware('permission:Menghapus Data Proses Rewash');

    //Packing
    Route::get('/proses/packing', [PageController::class, 'packing'])->middleware('permission:Membuka Menu Packing');
    Route::post('/proses/packing', [PackingController::class, 'create'])->middleware('permission:Menginputkan Data Packing');
});
