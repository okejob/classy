<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Data\Pelanggan;
use App\Models\Paket\PaketCuci;
use App\Models\Transaksi\ItemTransaksi;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TransaksiController extends Controller
{

    public function bucketPrice($total_bobot)
    {
        $paket_bucket = PaketCuci::where('nama_paket', 'BUCKET')->first();
        $total_harga = $total_bobot * $paket_bucket->harga_paket;

        return round($total_harga, 2);
    }

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
        $merged = $request->safe()->merge([
            'modified_by' => Auth::id(),
            'status' => "draft"
        ])->toArray();
        $transaksi = Transaksi::create($merged);
        return [
            'status' => 200,
            $transaksi
        ];
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
        $merged = $request->safe()->merge([
            'modified_by' => Auth::id(),
            'status' => User::getRole(Auth::id()),
            'express' => $express,
            'setrika_only' => $setrika_only,
        ])->toArray();
        $transaksi = Transaksi::find($id);
        $transaksi->update($merged);
        if (!empty($transaksi->kode) && $transaksi->status != "draft") {
            $count = Transaksi::where('status', '!=', 'draft')->count();
            $paded = str_pad($count, 6, '0', STR_PAD_LEFT);
            $transaksi->kode = 'TRANS-' . $paded;
            $transaksi->save();
        }
        return redirect()->intended(route('transaksi-bucket'));
    }

    public function getTransaksi($id)
    {
        $transaksi = Transaksi::detail()->find($id);
        return [
            'status' => 200,
            $transaksi,
        ];
    }

    public function getID()
    {
        $id = Transaksi::count() == 0 ? 1 : Transaksi::latest()->first()->id + 1;
        return [
            'status' => 200,
            $id,
        ];
    }
}
