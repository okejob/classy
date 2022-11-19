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
        $transaksi_id = $request->safe()->only('transaksi_id');
        $penerima = Penerima::where('transaksi_id', $transaksi_id)->first();
        if (!$penerima) {
            $delivery = PickupDelivery::where('transaksi_id', $transaksi_id)->first();
            if ($delivery && $request->ambil_di_outlet) {
                return [
                    'status' => 400,
                    'message' => 'Sudah di ambil di outlet'
                ];
            }
            $path = $this->upload($request, 'penerima');
            $merged = $request->safe()->merge([
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
            'status' => 200,
            $penerima
        ];
    }
}
