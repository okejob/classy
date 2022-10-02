<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPengeluaranRequest;
use App\Models\Data\Pengeluaran;
use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function insert(InsertPengeluaranRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()]);
        $pengeluaran = Pengeluaran::create($merged);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'insert',
            'table' => 'pengeluarans',
            'affected_id' => $pengeluaran->id,
        ]);

        return redirect()->intended('menu-pengeluaran');
    }

    public function delete($id)
    {
        Pengeluaran::destroy($id);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'delete',
            'table' => 'pengeluarans',
            'affected_id' => $id,
        ]);

        return redirect()->intended('menu-pengeluaran');
    }
}
