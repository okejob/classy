<?php

namespace App\Http\Controllers;

use App\Models\Data\JenisItem;
use App\Models\Data\Kategori;
use App\Models\Data\Parfum;
use App\Models\Data\Pelanggan;
use App\Models\Data\Pengeluaran;
use App\Models\Outlet;
use App\Models\Paket\PaketCuci;
use App\Models\Paket\PaketDeposit;
use App\Models\Permission\Role;
use App\Models\Transaksi\Penerima;
use App\Models\Transaksi\PickupDelivery;
use App\Models\Transaksi\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Gd\Driver;

class PageController extends Controller
{
    /**
     * Route To login page
     *
     * @return View login
     */
    public function login()
    {
        return view(
            'pages.session.login',
            [
                'cabangs' => Outlet::where("status", 1)->orderBy("nama", "asc")->get(),
            ]
        );
    }

    /**
     * Reset Password Page
     *
     * @return View reset password
     */
    public function resetPassword()
    {
        return view('pages.session.ubahPassword');
    }

    //Menampilkan Home
    public function dashboard()
    {
        return view('pages.session.home');
    }

    //Menampilkan Menu Jenis Item
    public function jenisItem(Request $request)
    {
        return view(
            'pages.data.Item',
            [
                'data1' => JenisItem::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("unit", $request->get("search"));
                })->orderBy("nama", "asc")->paginate(5),
                'data2' => Kategori::all()
            ]
        );
    }

    //Menampilkan Menu Kategori
    public function kategori(Request $request)
    {
        return view(
            'pages.data.Kategori',
            [
                'data' => Kategori::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("deskripsi", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5)
            ]
        );
    }

    //Menampilkan Menu Parfum
    public function parfum(Request $request)
    {
        return view(
            'pages.data.Parfum',
            [
                'data1' => Parfum::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("deskripsi", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5),
                'data2' => Parfum::select('jenis')->orderBy("jenis", "asc")->distinct()->get()
            ]
        );
    }

    //Menampilkan Menu Pelanggan
    public function pelanggan()
    {
        return view('pages.data.Pelanggan');
    }

    //Menampilkan Menu Pengeluaran
    public function pengeluaran(Request $request)
    {
        return view(
            'pages.data.Pengeluaran',
            [
                'data' => Pengeluaran::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("deskripsi", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5)
            ]
        );
    }

    //Menampilkan Menu Rewash
    public function rewash()
    {
        return view(
            'pages.data.Rewash'
        );
    }

    //Menampilkan Menu Karyawan
    public function karyawan()
    {
        return view(
            'pages.pengaturan.Karyawan',
            [
                'data' => User::paginate(5),
                'outlets' => Outlet::get(),
                'roles' => Role::get(),
            ]
        );
    }

    //Menampilkan Menu Outlet
    public function outlet(Request $request)
    {
        return view(
            'pages.pengaturan.Outlet',
            [
                'data' => Outlet::when($request->has("search"), function ($q) use ($request) {
                    return $q->where("kode", "like", "%" . $request->get("search") . "%")
                        ->orWhere("nama", "like", "%" . $request->get("search") . "%")
                        ->orWhere("alamat", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5)
            ]
        );
    }

    public function paketCuci()
    {
        return view(
            'pages.pengaturan.PaketCuci',
            [
                'data' => PaketCuci::paginate(5)
            ]
        );
    }

    public function paketDeposit()
    {
        return view(
            'pages.pengaturan.PaketDeposit',
            [
                'data' => PaketDeposit::where('id', '!=', 1)->paginate(5)
            ]
        );
    }

    public function pickupDelivery()
    {
        return view(
            'pages.transaksi.PickupDelivery',
            [
                'data2' => PickupDelivery::where('action', 'delivery')->paginate(5),
                'data3' => Penerima::where('ambil_di_outlet', 1)->paginate(5),
                'dataTransaksi' => Transaksi::get(),
                'dataPelanggan' => Pelanggan::get(),
                'dataDriver' => User::role('delivery')->get(),
            ]
        );
    }

    public function transaksi()
    {
        $data['transaksi_id'] = Transaksi::count() == 0 ? 1 : Transaksi::latest()->first()->id + 1;
        $data['last_transaksi'] = Transaksi::latest()->take(5)->get();
        $data['pelanggan'] = Pelanggan::latest()->take(5)->get();
        $data['pickup'] = PickupDelivery::where('action', 'pickup')->get();
        $data['delivery'] = PickupDelivery::where('action', 'delivery')->get();
        $data['parfum'] = Parfum::get();
        $data['outlet'] = Outlet::get();

        return view(
            'pages.transaksi.Transaksi',
            [
                'data' => $data
            ]
        );
    }

    public function saldo()
    {
        return view(
            'pages.transaksi.Saldo',
            [
                'paket_deposits' => PaketDeposit::where('status', 1)->where('id', '!=', 1)->orderBy('nominal', 'desc')->get(),
                'pelanggans' => Pelanggan::where('status', 1)->get(),
            ]
        );
    }

    public function pembayaran()
    {
        return view(
            'pages.transaksi.Pembayaran',
            [
                'transaksis' => Transaksi::with('pelanggan')->latest()->take(5)->get(),
            ]
        );
    }
}
