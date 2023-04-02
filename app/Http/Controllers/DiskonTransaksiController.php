<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\DiskonTransaksi;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;

class DiskonTransaksiController extends Controller
{
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
            $list = DiskonTransaksi::where('transaksi_id', $request->transaksi_id)->get();
            return [
                'status' => 200,
                'messaage' => 'Success',
                'data' => $list,
            ];
        } else {
            $list = DiskonTransaksi::where('transaksi_id', $request->transaksi_id)->get();
            return [
                'status' => 400,
                'messaage' => 'Code Not Found',
                'data' => $list,
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
