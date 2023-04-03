<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\DiskonTransaksi;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;

class DiskonTransaksiController extends Controller
{
    public function find($id)
    {
        return [
            'data' => DiskonTransaksi::with('diskon')->where('transaksi_id', $id)->get(),
        ];
    }

    public function insert(Request $request)
    {
        $diskon = Diskon::where('code', $request->code)->first();
        if ($diskon) {
            DiskonTransaksi::create([
                'transaksi_id' => $request->transaksi_id,
                'diskon_id' => $diskon->id
            ]);
            $transaksi = Transaksi::find($request->transaksi_id);
            $transaksi->recalculate();
            return [
                'status' => 200,
                'message' => 'Success'
            ];
        } else {
            return [
                'status' => 400,
                'message' => 'Code Not Found',
            ];
        }
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
