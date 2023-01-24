<?php

namespace App\Http\Controllers;

use App\Http\Traits\LaporanInventoryTrait;
use App\Models\Inventory\Inventory;
use App\Models\Inventory\LaporanInventory;
use Illuminate\Http\Request;

class LaporanInventoryController extends Controller
{
    use LaporanInventoryTrait;

    public function insert(Request $request)
    {
        $request->validate([
            'inventory_id' => 'required|exists:inventories,id',
            'jumlah' => 'required|integer',
        ]);

        LaporanInventoryTrait::stockist($request->inventory_id, $request->jumlah);
        return [
            'status' => '200',
            'message' => 'success'
        ];
    }
}
