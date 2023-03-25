<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertItemTransaksiRequest;
use App\Models\Data\JenisItem;
use App\Models\Transaksi\ItemTransaksi;
use App\Models\Transaksi\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemTransaksiController extends Controller
{
    //Menambahkan Item ke Transaksi
    public function addItemToTransaksi(Request $request)
    {
        $request['modified_by'] = Auth::id();
        $role = User::getRole(Auth::id());
        $jenis_item = JenisItem::find($request['jenis_item_id']);
        $request['bobot_bucket'] = $jenis_item->bobot_bucket;
        $request['harga_premium'] = $jenis_item->harga_premium;
        $request['diskon_jenis_item'] = $jenis_item->diskon_jenis_item;
        $request['status_proses'] = $role;
        $request['total_bobot'] = $jenis_item->bobot_bucket;
        $finder = ItemTransaksi::where('transaksi_id', $request->transaksi_id)->where('jenis_item_id', $request->jenis_item_id)->first();
        if ($finder) {
            $finder->qty = $finder->qty + 1;
            $finder->bobot_bucket = $jenis_item->bobot_bucket;
            $finder->harga_premium = $jenis_item->harga_premium;
            $finder->diskon_jenis_item = $jenis_item->diskon_jenis_item;
            $finder->total_bobot = $finder->qty * $finder->bobot_bucket;
            $finder->total_premium = $finder->qty * $finder->harga_premium;
            $finder->save();
        } else {
            $item_transaksi = ItemTransaksi::create($request->toArray());
            $item_transaksi->qty = $item_transaksi->qty + 1;
            $item_transaksi->total_bobot = $item_transaksi->qty * $item_transaksi->bobot_bucket;
            $item_transaksi->total_premium = $item_transaksi->qty * $item_transaksi->harga_premium;
            $item_transaksi->save();
        }

        $transaksi = Transaksi::detail()->find($request['transaksi_id'])->recalculate();
        $transaksi->modified_by = Auth::id();
        $transaksi->save();
        return  [
            'status' => 200,
            $transaksi,
        ];
    }

    public function updateQty(Request $request, $id)
    {
        $item_transaksi = ItemTransaksi::find($id);
        $item_transaksi->update([
            'qty' => $request->qty,
            'total_bobot' => $request->qty * $item_transaksi->bobot_bucket,
            'total_premium' => $request->qty * $item_transaksi->harga_premium,
        ]);
        $item_transaksi->save();

        $transaksi = Transaksi::detail()->find($item_transaksi->transaksi_id)->recalculate();
        $transaksi->modified_by = Auth::id();
        $transaksi->save();
        return [
            'status' => 200,
            'qty' => $request->qty
        ];
    }

    //Menyimpan Item Transaksi ke DB
    public function insert(InsertItemTransaksiRequest $request)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        ItemTransaksi::create($merged);

        return redirect()->intended(route(''));
    }

    //Menampilkan Detail Item transaksi
    public function show($id)
    {
        $item_transaksi = ItemTransaksi::find($id);
        return [
            'status' => 200,
            $item_transaksi,
        ];
    }

    //Mengupdate Detail Item Transaksi
    public function update(InsertItemTransaksiRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        ItemTransaksi::find($id)->update($merged);

        return redirect()->intended(route(''));
    }

    //Menghapus Item Transaksi
    public function delete(ItemTransaksi $id)
    {
        $id_transaksi = $id->transaksi_id;
        $id->delete();

        $transaksi = Transaksi::find($id_transaksi)->recalculate();
        return  [
            'status' => 200,
            $transaksi,
        ];
    }
}
