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

    public function historyPelanggan($id_pelanggan)
    {
        $transaksi = Transaksi::detail()->where('pelanggan_id', $id_pelanggan)->paginate(5);

        return [
            'status' => 200,
            $transaksi
        ];
    }

    //Mencari Transaksi dengan KEY id, Kode Transaksi, atau Nama Pelanggan
    public function search($key)
    {
        $transaksi = Transaksi::detail()
            ->where('id', 'like', '%' . $key . '%')
            ->orWhere('kode', 'like', '%' . $key . '%')
            ->orWhereHas('pelanggan', function ($q) use ($key) {
                $q->where('nama', 'like', '%' . $key . '%');
            })->take(5)->get();
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
        $merged = $request->merge([
            'modified_by' => Auth::id(),
            'status' => User::getRole(Auth::id()),
            'express' => $express,
            'setrika_only' => $setrika_only,
        ])->toArray();
        $transaksi = Transaksi::find($id);
        $transaksi->update($merged);
        if (empty($transaksi->kode) && $transaksi->status != "draft") {
            $count = Transaksi::where('status', '!=', 'draft')->count() + 1;
            $paded = str_pad($count, 6, '0', STR_PAD_LEFT);
            $transaksi->kode = 'TRANS-' . $paded;
            $transaksi->save();
        }
        return redirect()->intended(route('transaksi'));
    }

    //Mengubah Status item menjadi "Cuci"
    public function changeStatusCuci(Transaksi $transaksi)
    {
        if (empty($transaksi->pencuci)) {
            $transaksi->pencuci = Auth::id();
            $transaksi->save();
        }
    }

    public function clearStatusCuci(Transaksi $transaksi)
    {
        if (!empty($transaksi->pencuci)) {
            $transaksi->pencuci = NULL;
            $transaksi->save();
        }
    }

    //Mengubah Status itetm menjadi "Setrika"
    public function changeStatusSetrika(Transaksi $transaksi)
    {
        if (empty($transaksi->penyetrika)) {
            $transaksi->penyetrika = Auth::id();
            $transaksi->save();
        }
    }

    public function clearStatusSetrika(Transaksi $transaksi)
    {
        if (!empty($transaksi->penyetrika)) {
            $transaksi->penyetrika = NULL;
            $transaksi->save();
        }
    }
}
