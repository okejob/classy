<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertTransaksiRequest;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{

    public function insert(InsertTransaksiRequest $request)
    {
    }

    public function getTransaksi($id)
    {
        $transaksi = Transaksi::detail()->find($id);
        return [
            'status' => 200,
            $transaksi,
        ];
    }
}
