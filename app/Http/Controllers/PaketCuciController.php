<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPaketCuciRequest;
use App\Models\Paket\PaketCuci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketCuciController extends Controller
{
    public function insert(InsertPaketCuciRequest $request)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        PaketCuci::create($merged);

        return redirect()->intended(route('menu-paket'));
    }

    public function show($id)
    {
        $paket_cuci = PaketCuci::find($id);
        return [
            'status' => 200,
            $paket_cuci,
        ];
    }

    public function update(InsertPaketCuciRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        PaketCuci::find($id)->update($merged);

        return redirect()->intended(route('menu-paket'));
    }

    public function delete($id)
    {
        PaketCuci::destroy($id);

        return redirect()->intended(route('menu-paket'));
    }
}
