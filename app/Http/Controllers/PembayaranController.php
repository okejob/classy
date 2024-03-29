<?php

namespace App\Http\Controllers;

use App\Models\Data\Pelanggan;
use App\Models\Pembayaran;
use App\Models\Saldo;
use App\Models\Transaksi\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function insert(Request $request)
    {
        $user = User::find(auth()->id());
        $permissions = $user->getPermissionsViaRoles();
        $permissionExist = collect($permissions)->first(function ($item) {
            return $item->name === 'Membuat Pembayaran';
        });
        if ($permissionExist) {
            $request->validate([
                'nominal' => 'required|integer'
            ]);
            // $transaksi = Transaksi::find($request->transaksi_id);
            // $pelanggan = Pelanggan::find($transaksi->pelanggan_id);
            // $saldo = Saldo::where('pelanggan_id', $transaksi->pelanggan_id);
            // if ($saldo->saldo_akhir > 0) {
            // }else{
            // }
            Pembayaran::create([
                'nominal' => $request->nominal,
                'outlet_id' => $user->outlet_id,
                'transaksi_id' => $request->transaksi_id,
                'saldo_id' => $request->saldo_id,
                'metode_pembayaran' => $request->metode_pembayaran
            ]);

            //Mengubah Total Transaksi
            $transaksi = Transaksi::find($request->transaksi_id);
            $total_terbayar = $transaksi->total_terbayar + (int) $request->nominal;
            if ($total_terbayar >= $transaksi->grand_total) {
                $transaksi->total_terbayar = $transaksi->grand_total;
                $transaksi->lunas = true;
            } else {
                $transaksi->total_terbayar = $total_terbayar;
            }
            $transaksi->save();

            return redirect()->intended(route('menu_pembayaran'));
        } else {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSION');
        }
    }

    public function bayarTagihan(Request $request)
    {
        $user = User::find(auth()->id());
        $permissions = $user->getPermissionsViaRoles();
        $permissionExist = collect($permissions)->first(function ($item) {
            return $item->name === 'Membuat Pembayaran';
        });
        if ($permissionExist) {
            $transaksis = Transaksi::where('pelanggan_id', $request->pelanggan_id)
                ->where('lunas', false)
                ->oldest()
                ->get();
            $nominal = $request->nominal;
            foreach ($transaksis as $transaksi) {
                if ($nominal > 0) {
                    $tagihan_transaksi = $transaksi->grand_total - $transaksi->total_terbayar;

                    if ($nominal >= $tagihan_transaksi) {
                        $transaksi->total_terbayar = $transaksi->grand_total;
                        $transaksi->lunas = true;
                        $nominal -= $tagihan_transaksi;

                        Pembayaran::create([
                            'outlet_id' => $user->outlet_id,
                            'nominal' => $transaksi->total_terbayar,
                            'transaksi_id' => $transaksi->id,
                            'metode_pembayaran' => 'cash'
                        ]);
                    } else {
                        $transaksi->total_terbayar = $transaksi->total_terbayar + $nominal;
                        Pembayaran::create([
                            'nominal' => $nominal,
                            'transaksi_id' => $transaksi->id,
                            'metode_pembayaran' => 'cash'
                        ]);
                        $nominal = 0;
                    }
                    $transaksi->save();
                } else {
                    break;
                }
            }
            return [
                'status' => 200,
                'message' => 'success',
            ];
        } else {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSION');
        }
    }

    public function show(Pembayaran $pembayaran)
    {
        $user = User::find(auth()->id());
        $permissions = $user->getPermissionsViaRoles();
        $permissionExist = collect($permissions)->first(function ($item) {
            return $item->name === 'Melihat Detail Pembayaran';
        });
        if ($permissionExist) {
            return [
                'status' => 200,
                $pembayaran
            ];
        } else {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSION');
        }
    }

    public function update(Request $request, Pembayaran $pembayaran)
    {
        $user = User::find(auth()->id());
        $permissions = $user->getPermissionsViaRoles();
        $permissionExist = collect($permissions)->first(function ($item) {
            return $item->name === 'Mengubah Data Pembayaran';
        });
        if ($permissionExist) {
            $request->validate([
                'nominal' => 'required|integer'
            ]);

            $pembayaran->update([
                'nominal' => $request->nominal,
                'outlet_id' => $user->outlet_id,
                'transaksi_id' => $request->transaksi_id,
                'saldo_id' => $request->saldo_id,
                'metode_pembayaran' => $request->metode_pembayaran
            ]);

            return redirect()->intended(route('menu_pembayaran'));
        } else {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSION');
        }
    }

    public function delete(Pembayaran $pembayaran)
    {
        $user = User::find(auth()->id());
        $permissions = $user->getPermissionsViaRoles();
        $permissionExist = collect($permissions)->first(function ($item) {
            return $item->name === 'Menghapus Pembayaran';
        });
        if ($permissionExist) {
            $pembayaran->delete();

            return [
                'status' => 200,
                'message' => 'Sukses Terhapus'
            ];
        } else {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSION');
        }
    }
}
