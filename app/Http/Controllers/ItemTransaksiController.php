<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertItemTransaksiRequest;
use App\Models\Transaksi\ItemTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemTransaksiController extends Controller
{
    public function insert(InsertItemTransaksiRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        ItemTransaksi::create($merged);

        return redirect()->intended(route(''));
    }

    public function show($id)
    {
        $item_transaksi = ItemTransaksi::find($id);
        return [
            'status' => 200,
            $item_transaksi,
        ];
    }

    public function update(InsertItemTransaksiRequest $request, $id)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        ItemTransaksi::find($id)->update($merged);

        return redirect()->intended(route(''));
    }

    public function delete($id)
    {
        ItemTransaksi::destroy($id);

        return redirect()->intended(route(''));
    }
}
