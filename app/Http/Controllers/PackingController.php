<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPackingRequest;
use App\Http\Traits\LaporanInventoryTrait;
use App\Models\Data\Pelanggan;
use App\Models\Inventory\Inventory;
use App\Models\LogTransaksi;
use App\Models\Packing\Packing;
use App\Models\Packing\PackingInventory;
use App\Models\Transaksi\PickupDelivery;
use App\Models\Transaksi\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackingController extends Controller
{
    use LaporanInventoryTrait;

    public function create(InsertPackingRequest $request)
    {
        $user = User::find(auth()->id());
        $permissions = $user->getPermissionsViaRoles();
        $permissionExist = collect($permissions)->first(function ($item) {
            return $item->name === 'Menginputkan Data Packing';
        });
        if ($permissionExist) {
            $transaksi = Transaksi::find($request->transaksi_id);
            $count = PickupDelivery::where('action', "delivery")->count() + 1;
            $paded = str_pad($count, 6, '0', STR_PAD_LEFT);
            $kode = 'DV-' . $paded;

            $pelanggan = Pelanggan::find($transaksi->pelanggan_id);
            $alamat = $pelanggan->alamat;

            $packing = Packing::create([
                'transaksi_id' => $request->transaksi_id,
                // 'pickup_delivery_id' => $pickup_delivery->id,
                'modified_by' => Auth::id(),
            ]);

            $inventories = json_decode($request->inventories);
            // dd($request->inventories);
            foreach ($inventories as $inventory) {
                $packing_inventory = PackingInventory::create([
                    'packing_id' => $packing->id,
                    'inventory_id' => $inventory->inventory_id,
                    'qty' => $inventory->qty,
                ]);
                LaporanInventoryTrait::stockist($inventory->inventory_id, $inventory->qty);
                $stock = Inventory::find($inventory->inventory_id);
                $stock->stok = $stock->stok - $inventory->qty;
                $stock->save();
            }
            LogTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'penanggung_jawab' => Auth::id(),
                'process' => strtoupper('packing transaksi')
            ]);
            return [
                'status' => 200,
                'message' => 'success',
            ];
        } else {
            abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSION');
        }
    }

    public function tablePacking($id)
    {
        return view('components.tablePacking', [
            'transaksi' => Transaksi::detail()->find($id),
            'inventories' => Inventory::where('kategori', 'packing')->get(),
        ]);
    }
}
