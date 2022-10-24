<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPickupDeliveryRequest;
use App\Models\Transaksi\PickupDelivery;
use App\Models\Transaksi\Transaksi;
use App\Models\Transaksi\TransaksiPickupDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupDeliveryController extends Controller
{
    public function insert(InsertPickupDeliveryRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        $pickup_delivery = PickupDelivery::create($merged);
        $action = $request->action;
        if ($action == "pickup") {
            $transaksi = Transaksi::create([
                'pelanggan_id' => $request->safe()->only('pelanggan_id'),
                'status' => 'draft',
            ]);

            $transaksi_pickup_delivery = TransaksiPickupDelivery::create([
                'transaksi_id' => $transaksi->id,
                'pickup_delivery_id' => $pickup_delivery->id,
            ]);
        }
        return redirect()->intended(route('pickup-delivery'));
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
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        PickupDelivery::find($id)->update($merged);

        //return redirect()->intended(route(''));
    }

    public function delete($id)
    {
        PickupDelivery::destroy($id);

        //return redirect()->intended(route(''));
    }
}
