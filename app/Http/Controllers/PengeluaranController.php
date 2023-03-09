<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPengeluaranRequest;
use App\Models\Data\Pengeluaran;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function insert(InsertPengeluaranRequest $request)
    {
        $outlet_id = Auth::user()->outlet_id;
        $outlet = Outlet::find($outlet_id);
        if ($outlet->saldo >= $request->nominal) {

            $merged = $request->merge([
                'modified_by' => Auth::id(),
                'outlet_id' => Auth::user()->outlet_id
            ])->toArray();
            Pengeluaran::create($merged);
            $outlet->update([
                'saldo' => $outlet->saldo - $request->nominal
            ]);
            return redirect()->intended(route('menu-pengeluaran'));
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Saldo Kurang'
            ]);
        }

        // $merged = $request->merge([
        //     'modified_by' => Auth::id(),
        //     'outlet_id' => Auth::user()->outlet_id
        // ])->toArray();
        // Pengeluaran::create($merged);
        // return redirect()->intended(route('menu-pengeluaran'));
    }

    public function show($id)
    {
        $pengeluaran = Pengeluaran::find($id);
        return [
            'status' => 200,
            $pengeluaran,
        ];
    }

    public function update(InsertPengeluaranRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        Pengeluaran::find($id)->update($merged);

        return redirect()->intended(route('menu-pengeluaran'));
    }

    public function delete($id)
    {
        Pengeluaran::destroy($id);

        return redirect()->intended(route('menu-pengeluaran'));
    }
}
