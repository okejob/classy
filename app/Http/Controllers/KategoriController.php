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
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        Kategori::create($merged);

        return redirect()->intended(route('menu-kategori'));
    }

    public function update(InsertKategoriRequest $request, $id)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        Kategori::find($id)->update($merged);

        return redirect()->intended(route('menu-kategori'));
    }

    public function delete($id)
    {
        Kategori::destroy($id);

        return redirect()->intended(route('menu-kategori'));
    }
}
