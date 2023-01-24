<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPackingRequest;
use App\Http\Traits\LaporanInventoryTrait;
use App\Models\Data\Pelanggan;
use App\Models\Inventory\Inventory;
use App\Models\Packing\Packing;
use App\Models\Packing\PackingInventory;
use App\Models\Transaksi\PickupDelivery;
use App\Models\Transaksi\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackingController extends Controller
{
    use LaporanInventoryTrait;

    public function create(InsertPackingRequest $request)
    {
        $transaksi = Transaksi::find($request->transaksi_id);
        $count = PickupDelivery::where('action', "delivery")->count() + 1;
        $paded = str_pad($count, 6, '0', STR_PAD_LEFT);
        $kode = 'DV-' . $paded;

        $alamat = '';
        if (empty($request->alamat)) {
            $pelanggan = Pelanggan::find($transaksi->pelanggan_id);
            $alamat = $pelanggan->alamat;
        } else {
            $alamat = $request->alamat;
        }

        $pickup_delivery = PickupDelivery::create([
            'kode' => $kode,
            'transaksi_id' => $request->transaksi_id,
            'pelanggan_id' => $transaksi->pelanggan_id,
            'action' => 'delivery',
            'is_done' => false,
            'alamat' => $alamat,
            'modified_by' => Auth::id(),
        ]);

        $packing = Packing::create([
            'transaksi_id' => $request->transaksi_id,
            'pickup_delivery_id' => $pickup_delivery->id,
            'modified_by' => Auth::id(),
        ]);

        $inventories = $request->inventories;
        foreach ($inventories as $inventory) {
            $packing_inventory = PackingInventory::create([
                'packing_id' => $packing->id,
                'inventory_id' => $inventory->id,
                'qty' => $inventory->qty,
            ]);
            LaporanInventoryTrait::stockist($inventory->id, $inventory->qty);
        }

        return [
            'status' => 200,
            'message' => 'success',
        ];
    }
}
