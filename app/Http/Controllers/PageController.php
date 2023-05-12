<?php

namespace App\Http\Controllers;

use App\Models\Data\JenisItem;
use App\Models\Data\JenisRewash;
use App\Models\Data\Kategori;
use App\Models\Data\Parfum;
use App\Models\Data\Pelanggan;
use App\Models\Data\Pengeluaran;
use App\Models\Diskon;
use App\Models\Inventory\Inventory;
use App\Models\LogTransaksi;
use App\Models\Outlet;
use App\Models\Paket\PaketCuci;
use App\Models\Paket\PaketDeposit;
use App\Models\Permission\Role;
use App\Models\Transaksi\Penerima;
use App\Models\Transaksi\PickupDelivery;
use App\Models\Transaksi\Rewash;
use App\Models\Transaksi\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
                'outlets' => Outlet::where("status", 1)->orderBy("nama", "asc")->get(),
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
                'kategoris' => Kategori::all()
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
                })->where('outlet_id', Auth::user()->outlet_id)->orderBy("nama", "asc")->paginate(5)
            ]
        );
    }

    //Menampilkan Menu Rewash
    public function dataRewash()
    {
        return view(
            'pages.data.Rewash',
            [
                'jenisRewashes' => JenisRewash::paginate(5),
            ]
        );
    }

    //Menampilkan Menu Rewash
    public function prosesRewash()
    {
        return view(
            'pages.proses.Rewash',
            [
                'rewashes' => Rewash::with('itemTransaksi')->get(),
                'jenisRewashes' => JenisRewash::get(),
                'transaksis' => Transaksi::latest()->get(),
                'pencucis' => User::role('produksi_cuci')->get(),
            ]
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

    public function listKaryawan(Request $request)
    {
        return view(
            'components.tableKaryawan',
            [
                'karyawans' => User::when($request->has("search"), function ($q) use ($request) {
                    return $q->Where("name", "like", "%" . $request->get("search") . "%");
                })->orderBy("id", "asc")->paginate(5),
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
                'pickups' => PickupDelivery::where('action', 'pickup')->get(),
                'deliveries' => PickupDelivery::where('action', 'delivery')->get(),
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

    public function bucket()
    {
        $data['transaksi_id'] = Transaksi::count() == 0 ? 1 : Transaksi::latest()->first()->id + 1;
        $data['last_transaksi'] = Transaksi::where('kode', 'not like', 'PR-%')->orwhere('kode', null)->latest()->take(5)->get();
        $data['pelanggan'] = Pelanggan::latest()->take(5)->get();
        $data['pickup'] = PickupDelivery::where('action', 'pickup')->get();
        $data['delivery'] = PickupDelivery::where('action', 'delivery')->get();
        $data['parfum'] = Parfum::get();
        $data['outlet'] = Outlet::get();

        return view(
            'pages.transaksi.Bucket',
            [
                'data' => $data
            ]
        );
    }

    public function premium()
    {
        $data['transaksi_id'] = Transaksi::count() == 0 ? 1 : Transaksi::latest()->first()->id + 1;
        $data['last_transaksi'] = Transaksi::where('kode', 'not like', 'BU-%')->orwhere('kode', null)->latest()->take(5)->get();
        $data['pelanggan'] = Pelanggan::latest()->take(5)->get();
        $data['pickup'] = PickupDelivery::where('action', 'pickup')->get();
        $data['delivery'] = PickupDelivery::where('action', 'delivery')->get();
        $data['parfum'] = Parfum::get();
        $data['outlet'] = Outlet::get();

        return view(
            'pages.transaksi.Premium',
            [
                'data' => $data
            ]
        );
    }

    public function hubCuci()
    {
        $role = User::getRole(Auth::id());
        $data['transaksis'] = Transaksi::detail()->latest()->get();
        $data['rewashes'] = Rewash::with('itemTransaksi')->where('pencuci', Auth::id())->get();
        if ($role != 'produksi_cuci') {
            $data['pencucis'] = User::role('produksi_cuci')->with('cucian')->get();
        }

        return view('pages.proses.Cuci', $data);
    }

    public function hubSetrika()
    {
        $data['transaksis'] = Transaksi::detail()->latest()->get();
        $data['jenis_rewashes'] = JenisRewash::get();
        $data['rewash'] = Rewash::get();
        $data['penyetrikas'] = User::role('produksi_setrika')->with('setrikaan')->get();
        return view('pages.proses.Setrika', $data);
    }

    public function packing()
    {
        return view('pages.proses.Packing',
            [
                'last_transaksi' => Transaksi::latest()->paginate(5),
                'inventories' => Inventory::where('kategori','packing')->get(),
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

    public function inventory(Request $request)
    {
        return view(
            'pages.data.Inventory',
            [
                'inventories' => Inventory::when($request->has("search"), function ($q) use ($request) {
                    return $q->Where("nama", "like", "%" . $request->get("search") . "%");
                })->orderBy("nama", "asc")->paginate(5)
            ]
        );
    }

    public function diskon(Request $request)
    {
        return view(
            'pages.data.Diskon',
            [
                'diskons' => Diskon::withTrashed()->orderBy("code", "asc")->paginate(5)
            ]
        );
    }

    public function cancel(Request $request)
    {
        return view(
            'pages.transaksi.Cancelled',
            [
                'last_transaksi' => Transaksi::when($request->has("search"), function ($q) use ($request) {
                    return $q->Where("kode", "like", "%" . $request->get("search") . "%");
                })->orderBy("id", "desc")->onlyTrashed()->paginate(10),
            ]
        );
    }
}
