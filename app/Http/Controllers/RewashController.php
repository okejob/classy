<?php

namespace App\Http\Controllers;

use App\Models\Transaksi\Rewash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewashController extends Controller
{
    public function insert(Request $request)
    {
        Rewash::create([
            'item_transaksi_id' => $request->item_transaksi_id,
            'jenis_rewash_id' => $request->jenis_rewash_id,
            'modified_by' => Auth::id(),
        ]);

        return redirect()->intended(route('menu-rewash'));
    }

    public function updateStatus(Request $request, Rewash $rewash)
    {
        $rewash->update([
            'status' => $request->status
        ]);

        return redirect()->intended(route('menu-rewash'));
    }

    public function delete(Rewash $rewash)
    {
        $rewash->delete();

        return redirect()->intended(route('menu-rewash'));
    }
}
