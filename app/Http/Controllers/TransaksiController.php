<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertTransaksiRequest;
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
        $validated = $request->validated();

        $transaksi = Transaksi::create([
            'pelanggan_id' => $validated['pelanggan_id'],
            'outlet_input_id' => $validated['outlet_input_id'],
            'cashier_id' => $validated['cashier_id'],
            'pickup_delivery_id' => $validated['pickup_delivery_id'],
            'parfum_id' => $validated['parfum_id'],
            'express' => $validated['express'],
            'setrika_only' => $validated['setrika_only'],
            'catatan' => $validated['catatan'],
        ]);

        $transaksi = Transaksi::find($transaksi->id)->recalculate();

        $status = User::getRole(Auth::id());
        $transaksi->status = $status;
        $transaksi->save();
    }

    public function update(InsertTransaksiRequest $request, $id)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        Transaksi::find($id)->update($merged);

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
