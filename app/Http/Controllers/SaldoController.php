<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaldoController extends Controller
{
    public function insert(Request $request)
    {
        $saldo_akhir = Saldo::where('pelanggan_id', $request->pelanggan_id)->latest()->first()->saldo_akhir;

        if ($request->jenis_input == "tambah") {
            $saldo_akhir += $request->nominal;
        } else {
            $saldo_akhir -= $request->nominal;
        }

        Saldo::create([
            'pelanggan_id' => $request->pelanggan_id,
            'paket_deposit_id' => $request->paket_deposit_id,
            'nominal' => $request->nominal,
            'jenis_input' => $request->jenis_input,
            'saldo_akhir' => $saldo_akhir,
            'modified_by' => Auth::id()
        ]);

        return null;
    }
}
