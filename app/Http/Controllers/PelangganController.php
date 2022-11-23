<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPelangganRequest;
use App\Models\Data\Pelanggan;
use App\Models\Saldo;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function insert(InsertPelangganRequest $request)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        Pelanggan::create($merged);

        return redirect()->intended(route('menu-pelanggan'));
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
        return [
            'status' => 200,
            $pelanggan,
        ];
    }

    public function update(InsertPelangganRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        Pelanggan::find($id)->update($merged);

        return redirect()->back();
    }

    public function delete($id)
    {
        Pelanggan::destroy($id);

        return redirect()->intended(route('menu-pelanggan'));
    }

    public function detailPelanggan($id_pelanggan) {
        return view(
            'pages.data.DetailPelanggan',
            [
                'pelanggan' => Pelanggan::where('id', $id_pelanggan)->first(),
                'transaksis' => Transaksi::detail()->where('pelanggan_id', $id_pelanggan)->latest()->paginate(5),
                'saldos' => Saldo::where('pelanggan_id', $id_pelanggan)->latest()->paginate(5),
            ]
        );
    }
}
