<?php

namespace App\Http\Controllers;

use App\Models\Inventory\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function insert(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'stok' => 'numeric|min:0',
            'kategori' => 'required|string',
        ]);

        Inventory::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
        ]);

        return redirect()->intended(route('menu-inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'nama' => 'required|string',
            'stok' => 'numeric|min:0',
            'kategori' => 'required|kategori',
        ]);

        $inventory->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok
        ]);

        return redirect()->intended(route('menu-inventory'));
    }

    public function delete(Inventory $inventory)
    {
        $inventory->delete();

        return [
            'status' => 200,
            'message' => 'Success'
        ];
    }
}
