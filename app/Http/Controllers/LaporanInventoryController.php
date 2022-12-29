<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Inventory;
use Illuminate\Http\Request;

class LaporanInventoryController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'jumlah' => 'required|integer',
        ]);

        $inventory = Inventory::find($request->inventory_id);
        if ($inventory->stok - $request->jumlah > 0) {
            return [
                'status' => '400',
                'message' => 'stok kurang'
            ];
        }

        $inventory->stok = $inventory->stok + $request->jumlah;
        $inventory->save();

        return [
            'status' => '200',
            'message' => 'success'
        ];
    }
}
