<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
            'nominal' => 'required|integer'
        ]);

        Pembayaran::create([
            'nominal' => $request->nominal,
            'transaksi_id' => $request->transaksi_id,
            'saldo_id' => $request->saldo_id,
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

        //Mengubah Total Transaksi
        $transaksi = Transaksi::find($request->transaksi_id);
        $total_terbayar = $transaksi->total_terbayar + (int) $request->nominal;
        if ($total_terbayar >= $transaksi->grand_total) {
            $transaksi->total_terbayar = $transaksi->grand_total;
            $transaksi->lunas = true;
        } else {
            $transaksi->total_terbayar = $total_terbayar;
        }
        $transaksi->save();

        return redirect()->intended(route('menu_pembayaran'));
    }

    public function show(Pembayaran $pembayaran)
    {
        return [
            'status' => 200,
            $pembayaran
        ];
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'nominal' => 'required|integer'
        ]);

        $pembayaran->update([
            'nominal' => $request->nominal,
            'transaksi_id' => $request->transaksi_id,
            'saldo_id' => $request->saldo_id,
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

        return redirect()->intended(route('menu_pembayaran'));
    }

    public function delete(Pembayaran $pembayaran)
    {
        $pembayaran->delete();

        return [
            'status' => 200,
            'message' => 'Sukses Terhapus'
        ];
    }
}
