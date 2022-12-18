<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPenerimaRequest;
use App\Http\Traits\UploadTrait;
use App\Models\Transaksi\Penerima;
use App\Models\Transaksi\PickupDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    use UploadTrait;

    public function insert(InsertPenerimaRequest $request)
    {
        $transaksi_id = $request->only('transaksi_id');
        $penerima = Penerima::where('transaksi_id', $transaksi_id)->first();
        if (empty($penerima)) {
            $delivery = PickupDelivery::where('transaksi_id', $transaksi_id)->where('action', 'delivery')->first();
            
            //Melakukan Pengecheckan apakah sudah dikirim tetapi request berisi ambil di outlet
            if (!empty($delivery) && $request->ambil_di_outlet == 1) {
                return [
                    'status' => 400,
                    'message' => 'Sudah di kirim.'
                ];
            }
            $path = $this->upload($request, 'penerima');
            $merged = $request->merge([
                'modified_by' => Auth::id(),
                'foto_penerima' => url($path),
            ])->toArray();
            $penerima = Penerima::create($merged);
            return [
                'status' => 200,
                $penerima
            ];
        }
        return [
            'status' => 400,
            $penerima
        ];
    }
}
