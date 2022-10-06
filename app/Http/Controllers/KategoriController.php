<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertKategoriRequest;
use App\Models\Data\Kategori;
use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function insert(InsertKategoriRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()]);
        $kategori = Kategori::create($merged);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'insert',
            'table' => 'kategoris',
            'affected_id' => $kategori->id,
        ]);

        return redirect()->intended('menu-kategori');
    }

    public function delete($id)
    {
        Kategori::destroy($id);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'delete',
            'table' => 'kategoris',
            'affected_id' => $id,
        ]);

        return redirect()->intended('menu-kategori');
    }

    //API
    public function APIshow()
    {
        $kategori = Kategori::get();
        return response()->json([
            'kategori' => $kategori,
        ], 200);
    }
}
