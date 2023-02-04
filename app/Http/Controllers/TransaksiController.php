<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Data\Pelanggan;
use App\Models\Paket\PaketCuci;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TransaksiController extends Controller
{

    public function show($id)
    {
        return Transaksi::detail()->find($id);
    }

    public function tableBucket($id)
    {
        return view('components.tableItemTransBucket', [
            'trans' => Transaksi::detail()->find($id),
        ]);
    }

    public function tablePremium($id)
    {
        return view('components.tableItemTransPremium', [
            'trans' => Transaksi::detail()->find($id),
        ]);
    }

    public function historyPelanggan($id_pelanggan)
    {
        $transaksi = Transaksi::detail()->where('pelanggan_id', $id_pelanggan)->paginate(5);

        return [
            'status' => 200,
            $transaksi
        ];
    }

    //Mencari Transaksi dengan KEY id, Kode Transaksi, atau Nama Pelanggan
    public function search(Request $request)
    {
        $tipe = '';
        if ($request->tipe == "bucket") {
            $tipe = 'BU-';
        } else {
            $tipe = 'PR-';
        }
        $transaksi = Transaksi::detail()
            ->where('kode', 'like', $tipe . '%')
            ->where(function ($query) use ($request) {
                $query->where('id', 'like', '%' . $request->key . '%')
                    ->orWhereHas('pelanggan', function ($q) use ($request) {
                        $q->where('nama', 'like', '%' . $request->key . '%');
                    });
            })
            ->take(5)->get();

        return [
            'status' => 200,
            $transaksi
        ];
    }

    //Mendapatkan harga Paket Bucket
    public function bucketPrice($total_bobot)
    {
        $paket_bucket = PaketCuci::where('nama_paket', 'BUCKET')->first();
        $total_harga = $total_bobot * $paket_bucket->harga_paket;

        return round($total_harga, 2);
    }

    //Menghitung nilai Transaksi
    public function checkHarga(Request $request)
    {
        $paket_bucket = PaketCuci::where('nama_paket', 'BUCKET')->first();
        $subtotal = $request->total_bobot * $paket_bucket->harga_paket;
        $diskon = 0;
        $diskon_member = $request->member == 0 ? 0 : 10;
        $grand_total = $subtotal * ((100 - ($diskon + $diskon_member)) / 100);

        return [
            'status' => 200,
            'subtotal' => $subtotal,
            'diskon' => $diskon,
            'grand_total' => $grand_total,
        ];
    }

    public function insert(InsertTransaksiRequest $request)
    {
        $merged = $request->merge([
            'outlet_id' => Auth::user()->outlet->id,
            'modified_by' => Auth::id(),
            'status' => "draft"
        ])->toArray();
        $transaksi = Transaksi::create($merged);
        $transaksi = Transaksi::detail()->find($transaksi->id);
        return [
            'status' => 200,
            $transaksi,
        ];
    }

    public function authenticationDiskon(UserLoginRequest $request)
    {
        $user = User::where('username', $request['username'])->first();
        $auth = Auth::attempt(['email' => $user->email, 'password' => $request['password']]);

        if ($auth) {
            $role = $user->getRole();
            if ($role == 'supervisor' || $role == 'administrator') {
                return [
                    'status' => 200,
                ];
            }
        }
        return back()->withErrors([
            'password' => 'Tidak Memiliki Akses'
        ]);
    }

    public function update(UpdateTransaksiRequest $request, $id)
    {
        $express = false;
        if ($request->express == "1") {
            $express = true;
        }
        $setrika_only = false;
        if ($request->setrika_only == "1") {
            $setrika_only = true;
        }
        $status = 'draft';
        if (
            User::getRole(Auth::id()) == "administrator"
            || User::getRole(Auth::id()) == "supervisor"
            || User::getRole(Auth::id()) == "operator"
        ) {
            $status = "confirmed";
        }
        $merged = $request->merge([
            'modified_by' => Auth::id(),
            'status' => $status,
            'express' => $express,
            'setrika_only' => $setrika_only,
        ])->toArray();
        $transaksi = Transaksi::find($id);
        $transaksi->update($merged);

        $kode = '';
        if ($request->tipe_transaksi == 'bucket') {
            $kode = 'BU-';
        } else {
            $kode = 'PR-';
        }

        if (empty($transaksi->kode) && $transaksi->status != "draft") {
            $count = Transaksi::where('status', '!=', 'draft')->where('kode', 'like', $kode . '%')->count();
            $paded = str_pad($count, 6, '0', STR_PAD_LEFT);

            $transaksi->kode = $kode . $paded;
            $transaksi->save();
        }
        return redirect()->intended(route('transaksi'));
    }

    //Mengubah Data Status item menjadi "Cuci"
    public function changeStatusCuci(Transaksi $transaksi)
    {
        if (empty($transaksi->pencuci)) {
            $transaksi->pencuci = Auth::id();
            $transaksi->save();
        }
    }

    public function clearStatusCuci(Transaksi $transaksi)
    {
        if (!empty($transaksi->pencuci) && $transaksi->pencuci == Auth::id()) {
            $transaksi->pencuci = NULL;
            $transaksi->save();
        }
    }

    //Mengubah Data Status itetm menjadi "Setrika"
    public function changeStatusSetrika(Transaksi $transaksi)
    {
        if (empty($transaksi->penyetrika)) {
            $transaksi->penyetrika = Auth::id();
            $transaksi->save();
        }
    }

    public function clearStatusSetrika(Transaksi $transaksi)
    {
        if (!empty($transaksi->penyetrika) && $transaksi->penyetrika == Auth::id()) {
            $transaksi->penyetrika = NULL;
            $transaksi->save();
        }
    }

    public function cancelTransaksi(Transaksi $transaksi)
    {
        $transaksi->update([
            'status' => "cancelled"
        ]);
        $transaksi->delete();
        return [];
    }

    public function restoreTransaksi($id)
    {
        $transaksi = Transaksi::withTrashed()->where('id', $id)->first();
        $transaksi->status = "draft";
        $transaksi->save();
        Transaksi::withTrashed()->where('id', $id)->restore();

        return [];
    }
}
