<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
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
