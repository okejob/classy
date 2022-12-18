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
        $request['status_proses'] = $role;
        $item_transaksi = ItemTransaksi::create($request->toArray());

        $transaksi = Transaksi::detail()->find($request['transaksi_id'])->recalculate();
        $transaksi->modified_by = Auth::id();
        $transaksi->save();
        return  [
            'status' => 200,
            $transaksi,
        ];
    }

    //Mengubah Status item menjadi "Cuci"
    public function changeStatusCuci(ItemTransaksi $item_transaksi)
    {
        if(empty($item_transaksi->pencuci)){
            $item_transaksi->pencuci = Auth::id();
            $item_transaksi->save();
        }
    }

    //Mengubah Status itetm menjadi "Setrika"
    public function changeStatusSetrika(ItemTransaksi $item_transaksi)
    {
        if(empty($item_transaksi->penyetrika)){
            $item_transaksi->penyetrika = Auth::id();
            $item_transaksi->save();
        }
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
