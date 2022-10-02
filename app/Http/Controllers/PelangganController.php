<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPelangganRequest;
use App\Models\Data\Pelanggan;
use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function insert(InsertPelangganRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()]);
        $pelanggan = Pelanggan::create($merged);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'insert',
            'table' => 'pelanggans',
            'affected_id' => $pelanggan->id,
        ]);

        return redirect()->intended('menu-pelanggan');
    }

    public function delete($id)
    {
        Pelanggan::destroy($id);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'delete',
            'table' => 'pelanggans',
            'affected_id' => $id,
        ]);

        return redirect()->intended('menu-parfum');
    }
}
