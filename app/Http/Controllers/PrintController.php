<?php

namespace App\Http\Controllers;

use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function dotMatrix($transaksi_id)
    {
        $transaksi = Transaksi::find($transaksi_id);
        
    }
}
