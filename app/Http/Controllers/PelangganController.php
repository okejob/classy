<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPelangganRequest;
use App\Models\Data\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelangganController extends Controller
{
    public function insert(InsertPelangganRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        $pelanggan = Pelanggan::create($merged);

        return redirect()->intended(route('menu-pelanggan'));
    }

    public function update(InsertPelangganRequest $request, $id)
    {
        $pelanggan = Pelanggan::find($id)->update($request->toArray());

        return redirect()->intended(route('menu-pelanggan'));
    }

    public function delete($id)
    {
        Pelanggan::destroy($id);

        return redirect()->intended(route('menu-parfum'));
    }

}
