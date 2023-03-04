<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DiskonController extends Controller
{
    public function insert(Request $request)
    {
        Diskon::create([
            'code' => $request->code,
            'description' => $request->description,
            'expired' => Date::createFromFormat('dd-mm-yyyy', $request->expired_date),
            'nominal' => $request->nominal
        ]);
    }

    public function update(Request $request, Diskon $diskon)
    {
        $diskon->update([
            'code' => $request->code,
            'description' => $request->description,
            'expired' => Date::createFromFormat('dd-mm-yyyy', $request->expired_date),
            'nominal' => $request->nominal
        ]);
    }

    public function addCodeToTransaksi(Transaksi $transaksi, $promo)
    {
        $diskon = Diskon::where('code', $promo)->first();
        if ($promo) {
            $transaksi->update([
                'promo_code' => $diskon->id,
                'diskon' => $diskon->nominal,
            ]);
            $transaksi->recalculate();
        } else {
            $transaksi->update([
                'promo_code' => null,
                'diskon' => 0
            ]);
        }
    }

    public function delete(Diskon $diskon)
    {
        $diskon->delete();

        return redirect()->intended(route('data-diskon'));
    }
}
