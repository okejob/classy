<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertKategoriRequest;
use App\Models\Data\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function insert(InsertKategoriRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()]);
        $kategori = Kategori::create($merged);

        return redirect()->intended('menu-kategori');
    }

    public function update(InsertKategoriRequest $request, $id)
    {
        $kategori = Kategori::find($id)->update($request->toArray());

        return redirect()->intended('menu-kategori');
    }

    public function delete($id)
    {
        Kategori::destroy($id);

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
