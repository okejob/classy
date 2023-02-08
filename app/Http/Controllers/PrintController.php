<?php

namespace App\Http\Controllers;

use App\Models\SettingUmum;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;

class PrintController extends Controller
{

    public function dotMatrix($transaksi_id)
    {
    }

    public function pdf($transaksi_id)
    {
        $transaksi = Transaksi::detail()->find($transaksi_id);
        $header = [
            'nama_usaha' => SettingUmum::where('nama', 'Print Header Nama Usaha')->first()->value,
            'delivery_text' => SettingUmum::where('nama', 'Print Header Delivery Text')->first()->value
        ];
        $pos = strpos($transaksi->kode, 'BU');
        if ($pos === false) {
            $transaksi->jenis_transaksi = 'PREMIUM';
        } else {
            $transaksi->jenis_transaksi = 'BUCKET';
        }
        $data = collect();
        $data->header = $header;
        $data->transaksi = $transaksi;

        //8.5x 11 inch = 612x792 point
        $paper_size = [0, 0, 612, 792];
        $pdf = Pdf::loadView('pages.print.template', ['data' => $data])->setPaper($paper_size, 'landscape');
        return $pdf->stream('invoice.pdf');
        //stream kalau preview, download kalau lsg download
    }
}
