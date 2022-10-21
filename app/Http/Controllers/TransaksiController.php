<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertTransaksiRequest;
use App\Models\Data\Pelanggan;
use App\Models\Paket\PaketCuci;
use App\Models\Transaksi\ItemTransaksi;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TransaksiController extends Controller
{

    public function checkRole($id)
    {
        $user = User::find($id);
        $roles = $user->getRoleNames();
        $role = $roles[0];
        return $role;
    }

    public function diskonMember($id)
    {
        $isMember = Pelanggan::find($id)->isMember();
        if ($isMember) {
            return 10;
        }
        return 0;
    }

    public function bucketPrice($total_bobot)
    {
        $paket_bucket = PaketCuci::where('nama_paket', 'BUCKET')->get();
        $total_harga = $total_bobot * $paket_bucket->harga_paket;

        return round($total_harga, 2);
    }

    public function insert(InsertTransaksiRequest $request)
    {
        $validated = $request->validated();
        $tipe_transaksi = $validated['tipe_transaksi'];

        $transaksi = Transaksi::create([
            'pelanggan_id' => $validated['pelanggan_id'],
            'outlet_input_id' => $validated['outlet_input_id'],
            'cashier_id' => $validated['cashier_id'],
            'pickup_delivery_id' => $validated['pickup_delivery_id'],
            'parfum_id' => $validated['parfum_id'],
            'express' => $validated['express'],
            'setrika_only' => $validated['setrika_only'],
            'catatan' => $validated['catatan'],
        ]);

        $total_bobot = 0;
        $jumlah_bucket = 0;
        $subtotal = 0;
        $diskon = 0;
        $diskon_member = $this->diskonMember($validated['pelanggan_id']);
        $grand_total = 0;

        $status = $this->checkRole(Auth::id());


        $item_transaksis = $request->safe()->only('item_transaksi');
        foreach ($item_transaksis as $item) {
            $item = ItemTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'jenis_item_id' => $item['jenis_item_id'],
                'bobot_bucket' => (float)$item['bobot_bucket'],
                'harga_premium' => $item['harga_premium'],
            ]);

            if ($tipe_transaksi == 'bucket') {
                $total_bobot +=  (float)$item['bobot_bucket'];
            } else {
                $subtotal += $item['harga_premium'];
            }
        }

        if ($tipe_transaksi == 'bucket') {
            $subtotal = $this->bucketPrice($total_bobot);
        }

        $grand_total = $subtotal * ((100 - ($diskon + $diskon_member)) / 100);

        $transaksi->total_bobot = $total_bobot;
        $transaksi->jumlah_bucket = $jumlah_bucket;
        $transaksi->subtotal = $subtotal;
        $transaksi->diskon = $diskon;
        $transaksi->diskon_member = $diskon_member;
        $transaksi->grand_total = $grand_total;
        $transaksi->status = $status;
        $transaksi->save();
    }

    public function getTransaksi($id)
    {
        $transaksi = Transaksi::detail()->find($id);
        return [
            'status' => 200,
            $transaksi,
        ];
    }
}
