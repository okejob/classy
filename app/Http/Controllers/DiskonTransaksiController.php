<?php

namespace App\Http\Controllers;

use App\Models\DiskonTransaksi;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;

class DiskonTransaksiController extends Controller
{
    public function insert(Request $request)
    {
        DiskonTransaksi::create([
            'transaksi_id' => $request->transaksi_id,
            'diskon_id' => $request->diskon_id
        ]);
        $transaksi = Transaksi::find($request->transaksi_id);
        $transaksi->recalculate();
        return [
            'status' => 200,
        ];
    }

    public function delete($id)
    {
        $transaksi = Transaksi::find($id);
        DiskonTransaksi::destroy($id);
        $transaksi->recalculate();
        return [
            'status' => 200,
        ];
    }
}
