<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Data\Pelanggan;
use App\Models\LogTransaksi;
use App\Models\Packing\Packing;
use App\Models\Packing\PackingInventory;
use App\Models\Paket\PaketCuci;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TransaksiController extends Controller
{

    public function show($id)
    {
        return Transaksi::detail()->find($id);
    }

    public function tableBucket($id)
    {
        return view('components.tableItemTransBucket', [
            'trans' => Transaksi::detail()->find($id),
        ]);
    }

    public function tablePremium($id)
    {
        return view('components.tableItemTransPremium', [
            'trans' => Transaksi::detail()->find($id),
        ]);
    }

    public function shortTable($id){
        return view('components.tableItemTransShort', [
            'trans' => Transaksi::detail()->find($id),
        ]);
    }

    public function shortTableDelivery($id){

        $packings = Packing::where('transaksi_id', $id)->get();

        $inventoryData = collect();

        foreach ($packings as $packing) {
            foreach ($packing->packing_inventories as $packingInventory) {
                $inventoryData->push([
                    'name' => $packingInventory->inventory->nama,
                    'qty' => $packingInventory->qty
                ]);
            }
        }

        return view('components.tableItemTransShort', [
            'trans' => Transaksi::detail()->find($id),
            'inventories' => $inventoryData,
        ]);


    }

    public function historyPelanggan($id_pelanggan)
    {
        return view('components.tableHistoryTransaksi', [
            'status' => 200,
            'transaksis' => Transaksi::detail()->where('pelanggan_id', $id_pelanggan)->latest()->paginate(5),
        ]);
    }

    //Mencari Transaksi dengan KEY id, Kode Transaksi, atau Nama Pelanggan
    public function search(Request $request)
    {
        $tipe = '';
        if ($request->tipe == "bucket") {
            $tipe = 'BU-';
        } else {
            $tipe = 'PR-';
        }
        $transaksi = Transaksi::detail()
            ->where('kode', 'like', $tipe . '%')
            ->where(function ($query) use ($request) {
                $query->where('id', 'like', '%' . $request->key . '%')
                    ->orWhereHas('pelanggan', function ($q) use ($request) {
                        $q->where('nama', 'like', '%' . $request->key . '%');
                    });
            })
            ->take(5)->get();

        return [
            'status' => 200,
            $transaksi
        ];
    }

    //Mendapatkan harga Paket Bucket
    public function bucketPrice($total_bobot)
    {
        $paket_bucket = PaketCuci::where('nama_paket', 'BUCKET')->first();
        $total_harga = $total_bobot * $paket_bucket->harga_paket;

        return round($total_harga, 2);
    }

    //Menghitung nilai Transaksi
    public function checkHarga(Request $request)
    {
        $paket_bucket = PaketCuci::where('nama_paket', 'BUCKET')->first();
        $subtotal = $request->total_bobot * $paket_bucket->harga_paket;
        $diskon = 0;
        $diskon_member = $request->member == 0 ? 0 : 10;
        $grand_total = $subtotal * ((100 - ($diskon + $diskon_member)) / 100);

        return [
            'status' => 200,
            'subtotal' => $subtotal,
            'diskon' => $diskon,
            'grand_total' => $grand_total,
        ];
    }

    public function insert(InsertTransaksiRequest $request)
    {
        $merged = $request->merge([
            'outlet_id' => Auth::user()->outlet->id,
            'modified_by' => Auth::id(),
            'status' => "draft"
        ])->toArray();
        $transaksi = Transaksi::create($merged);
        $transaksi = Transaksi::detail()->find($transaksi->id);
        LogTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'penanggung_jawab' => Auth::id(),
            'process' => strtoupper('create transaksi'),
        ]);
        return [
            'status' => 200,
            $transaksi,
        ];
    }

    public function authenticationDiskon(UserLoginRequest $request)
    {
        $user = User::where('username', $request['username'])->first();

        if ($user) {
            if (Hash::check($request['password'], $user->password)) {
                $role = $user->getRole($user->id);
                if ($role == 'supervisor' || $role == 'administrator') {
                    return [
                        'status' => 200,
                    ];
                }
            }
        }

        return [
            'password' => 'Tidak Memiliki Akses'
        ];
    }


    public function update(UpdateTransaksiRequest $request, $id)
    {
        $express = false;
        if ($request->express == "1") {
            $express = true;
        }
        $setrika_only = false;
        if ($request->setrika_only == "1") {
            $setrika_only = true;
        }
        $status = 'draft';
        if (
            User::getRole(Auth::id()) == "administrator"
            || User::getRole(Auth::id()) == "supervisor"
            || User::getRole(Auth::id()) == "operator"
        ) {
            $status = "confirmed";
        }
        $merged = $request->merge([
            'modified_by' => Auth::id(),
            'status' => $status,
            'express' => $express,
            'setrika_only' => $setrika_only,
        ])->toArray();
        $transaksi = Transaksi::find($id);
        $transaksi->update($merged);

        $kode = '';
        if ($request->tipe_transaksi == 'bucket') {
            $kode = 'BU-';
        } else {
            $kode = 'PR-';
        }

        if (empty($transaksi->kode) && $transaksi->status != "draft") {
            $count = Transaksi::where('status', '!=', 'draft')->where('kode', 'like', $kode . '%')->count() + 1;
            $paded = str_pad($count, 6, '0', STR_PAD_LEFT);

            $transaksi->kode = $kode . $paded;
            $transaksi->save();
        }
        LogTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'penanggung_jawab' => Auth::id(),
            'process' => strtoupper('update transaksi'),
        ]);
        return redirect()->back();
    }

    //Mengubah Data Status item menjadi "Cuci"
    public function changeStatusCuci(Transaksi $transaksi)
    {
        if (empty($transaksi->pencuci)) {
            $transaksi->pencuci = Auth::id();
            $transaksi->save();
            LogTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'penanggung_jawab' => Auth::id(),
                'process'=> strtoupper('take job cuci')
            ]);
        }
    }

    public function clearStatusCuci(Transaksi $transaksi)
    {
        if (!empty($transaksi->pencuci) && $transaksi->pencuci == Auth::id() && $transaksi->is_done_cuci != 1) {
            $transaksi->pencuci = NULL;
            $transaksi->save();
            LogTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'penanggung_jawab' => Auth::id(),
                'process'=> strtoupper('remove job cuci')
            ]);
        } else {
            return [
                "message" => "aksi tidak valid. proses cuci sudah selesai."
            ];
        }
    }

    public function doneCuci(Transaksi $transaksi)
    {
        if (!empty($transaksi->pencuci) && $transaksi->pencuci == Auth::id()) {
            $transaksi->is_done_cuci = 1;
            $transaksi->save();
            LogTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'penanggung_jawab' => Auth::id(),
                'process'=> strtoupper('done job cuci')
            ]);
        }
    }

    //Mengubah Data Status itetm menjadi "Setrika"
    public function changeStatusSetrika(Transaksi $transaksi)
    {
        if (empty($transaksi->penyetrika)) {
            $transaksi->penyetrika = Auth::id();
            $transaksi->save();
            LogTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'penanggung_jawab' => Auth::id(),
                'process'=> strtoupper('take job setrika')
            ]);
        }
    }

    public function clearStatusSetrika(Transaksi $transaksi)
    {
        if (!empty($transaksi->penyetrika) && $transaksi->penyetrika == Auth::id() && $transaksi->is_done_setrika != 1) {
            $transaksi->penyetrika = NULL;
            $transaksi->save();
            LogTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'penanggung_jawab' => Auth::id(),
                'process'=> strtoupper('remove job setrika')
            ]);
        } else {
            return [
                "message" => "aksi tidak valid. proses setrika sudah selesai."
            ];
        }
    }

    public function doneSetrika(Transaksi $transaksi)
    {
        if (!empty($transaksi->penyetrika) && $transaksi->penyetrika == Auth::id()) {
            $transaksi->is_done_setrika = 1;
            $transaksi->save();
            LogTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'penanggung_jawab' => Auth::id(),
                'process'=> strtoupper('done job setrika')
            ]);
        }
    }

    public function cancelTransaksi(Transaksi $transaksi)
    {
        $transaksi->update([
            'status' => "cancelled"
        ]);
        $transaksi->delete();
        LogTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'penanggung_jawab' => Auth::id(),
            'process'=> strtoupper('cancel transaksi')
        ]);
        return [];
    }

    public function restoreTransaksi($id)
    {
        $transaksi = Transaksi::withTrashed()->where('id', $id)->first();
        $transaksi->status = "draft";
        $transaksi->save();
        Transaksi::withTrashed()->where('id', $id)->restore();
        LogTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'penanggung_jawab' => Auth::id(),
            'process'=> strtoupper('restore transaksi from cancel')
        ]);
        return [];
    }

    public function logTransaksi($id)
    {
        return [
            "logs" => LogTransaksi::where('transaksi_id', $id)->get(),
        ];
    }
}
