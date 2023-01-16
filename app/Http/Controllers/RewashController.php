<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertJenisRewashRequest;
use App\Models\Data\JenisRewash;
use App\Models\Transaksi\ItemTransaksi;
use App\Models\Transaksi\Rewash;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewashController extends Controller
{

    public function test()
    {
        return Rewash::with('itemTransaksi')->get();
    }

    public function insert(Request $request)
    {
        $item_transaksi = ItemTransaksi::find($request->item_transaksi_id);
        $transaksi = Transaksi::find($item_transaksi->transaksi_id);
        Rewash::create([
            'item_transaksi_id' => $request->item_transaksi_id,
            'jenis_rewash_id' => $request->jenis_rewash_id,
            'modified_by' => Auth::id(),
            'pencuci' => $transaksi->pencuci,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back(); //->intended(route('menu-rewash'));
    }

    public function updateStatus(Request $request, Rewash $rewash)
    {
        $rewash->update([
            'status' => $request->status
        ]);

        return redirect()->intended(route('menu-rewash'));
    }

    public function delete(Rewash $rewash)
    {
        $rewash->delete();

        return redirect()->intended(route('menu-rewash'));
    }

    public function insertData(InsertJenisRewashRequest $request)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        JenisRewash::create($merged);

        return redirect()->intended(route('data-rewash'));
    }

    public function update(InsertJenisRewashRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        JenisRewash::find($id)->update($merged);

        return redirect()->back();
    }

    public function deleteData($id)
    {
        JenisRewash::destroy($id);

        return redirect()->intended(route('data-rewash'));
    }
}
