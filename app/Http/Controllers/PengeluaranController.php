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
        $pengeluaran = Pengeluaran::create($merged);

        return redirect()->intended(route('menu-pengeluaran'));
    }

    public function update(InsertPengeluaranRequest $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id)->update($request->toArray());

        return redirect()->intended(route('menu-pengeluaran'));
    }

    public function delete($id)
    {
        Pengeluaran::destroy($id);

        return redirect()->intended(route('menu-pengeluaran'));
    }

    //API
    public function APIshow()
    {
        $pengeluaran = Pengeluaran::get();
        return response()->json([
            'message' => 'Success',
            'pengeluaran' => $pengeluaran,
        ], 200);
    }

    public function APIinsert(InsertPengeluaranRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => 1])->toArray();
        $pengeluaran = Pengeluaran::create($merged);

        return response()->json([
            'message' => 'Success',
            'pengeluaran' => $pengeluaran,
        ], 200);
    }

    public function APIupdate(InsertPengeluaranRequest $request, $id)
    {
        $pengeluaran = Pengeluaran::find($id)->update($request->toArray());
        return response()->json([
            'message' => 'Success',
            'pengeluaran' => $pengeluaran,
        ], 200);
    }

    public function APIdelete($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        Pengeluaran::destroy($id);
        return response()->json([
            'message' => 'Success',
            'pengeluaran' => $pengeluaran,
        ], 200);
    }
}
