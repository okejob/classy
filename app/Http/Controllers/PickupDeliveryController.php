<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPickupDeliveryRequest;
use App\Models\Transaksi\Penerima;
use App\Models\Transaksi\PickupDelivery;
use App\Models\Transaksi\Transaksi;
use App\Models\Transaksi\TransaksiPickupDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupDeliveryController extends Controller
{
    public function insert(InsertPickupDeliveryRequest $request)
    {
        $action = $request->action;
        if ($action == "pickup") {
            $transaksi = Transaksi::create([
                'pelanggan_id' => $request->pelanggan_id,
                'outlet_id' => Auth::user()->outlet_id,
                'status' => 'draft',
            ]);
            $count = PickupDelivery::where('action', $action)->count();
            $paded = str_pad($count, 6, '0', STR_PAD_LEFT);
            $kode = 'PU-' . $paded;

            $merged = $request->safe()->merge([
                'kode' => $kode,
                'transaksi_id' => $transaksi->id,
                'modified_by' => Auth::id()
            ])->toArray();

            $pickup_delivery = PickupDelivery::create($merged);
            return redirect()->intended(route('pickup-delivery'))->with('message', 'Success Created Pickup');
        } else {
            $penerima = Penerima::where('transaksi_id', $request->transaksi_id)->first();
            if (empty($penerima)) {
                $count = PickupDelivery::where('action', $action)->count();
                $paded = str_pad($count, 6, '0', STR_PAD_LEFT);
                $kode = 'DV-' . $paded;

                $merged = $request->safe()->merge([
                    'kode' => $kode,
                    'modified_by' => Auth::id()
                ])->toArray();

                $pickup_delivery = PickupDelivery::create($merged);
                return redirect()->intended(route('pickup-delivery'))->with('message', 'Success Created Delivery');
            }

            return redirect()->back()->with('message', 'Sudah diterima');
        }
    }

    public function show($id)
    {
        $pickup_delivery = PickupDelivery::find($id);
        return [
            'status' => 200,
            $pickup_delivery,
        ];
    }

    public function update(InsertPickupDeliveryRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        PickupDelivery::find($id)->update($merged);

        //return redirect()->intended(route(''));
    }

    public function delete($id)
    {
        PickupDelivery::destroy($id);

        //return redirect()->intended(route(''));
    }
}
