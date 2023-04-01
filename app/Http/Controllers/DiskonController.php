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
            'jenis_diskon' => $request->jenis_diskon,
            'nominal' => $request->nominal,
            'maximal_diskon' => ($request->jenis_diskon == 'percentage') ? $request->maximal_diskon : 0,
            'expired' => Date::createFromFormat('Y-m-d', $request->expired_date),
        ]);
        return redirect()->intended(route('data-diskon'));
    }

    public function update(Request $request, Diskon $diskon)
    {
        $diskon->update([
            'code' => $request->code,
            'description' => $request->description,
            'jenis_diskon' => $request->jenis_diskon,
            'nominal' => $request->nominal,
            'maximal_diskon' => ($request->jenis_diskon == 'percentage') ? $request->maximal_diskon : 0,
            'expired' => Date::createFromFormat('Y-m-d', $request->expired_date),
        ]);
        $diskon->save();
        return redirect()->intended(route('data-diskon'));
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

    public function delete($id)
    {
        Diskon::destroy($id);

        return redirect()->intended(route('data-diskon'));
    }
}
