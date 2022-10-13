<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPickupDeliveryRequest;
use App\Models\Transaksi\PickupDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupDeliveryController extends Controller
{
    public function insert(InsertPickupDeliveryRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        PickupDelivery::create($merged);

        //return redirect()->intended(route(''));
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
