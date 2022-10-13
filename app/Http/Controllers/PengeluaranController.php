<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPengeluaranRequest;
use App\Models\Data\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function insert(InsertPengeluaranRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        Pengeluaran::create($merged);

        return redirect()->intended(route('menu-pengeluaran'));
    }

    public function update(InsertPengeluaranRequest $request, $id)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        Pengeluaran::find($id)->update($merged);

        return redirect()->intended(route('menu-pengeluaran'));
    }

    public function delete($id)
    {
        Pengeluaran::destroy($id);

        return redirect()->intended(route('menu-pengeluaran'));
    }
}
