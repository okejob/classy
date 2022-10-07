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
        $merged = $request->safe()->merge(['user_id' => Auth::id()]);
        $pelanggan = Pelanggan::create($merged);

        return redirect()->intended('menu-pelanggan');
    }

    public function update(InsertPelangganRequest $request, $id)
    {
        $pelanggan = Pelanggan::find($id)->update($request->toArray());

        return redirect()->intended('menu-pelanggan');
    }

    public function delete($id)
    {
        Pelanggan::destroy($id);

        return redirect()->intended('menu-parfum');
    }

    //API
    public function APIshow()
    {
        $pelanggan = Pelanggan::get();
        return response()->json([
            'message' => 'Success',
            'pelanggan' => $pelanggan,
        ], 200);
    }
    public function APIinsert(InsertPelangganRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => 1])->toArray();
        $pelanggan = Pelanggan::create($merged);

        return response()->json([
            'message' => 'Success',
            'pelanggan' => $pelanggan,
        ], 200);
    }

    public function APIupdate(InsertPelangganRequest $request, $id)
    {
        $pelanggan = Pelanggan::find($id)->update($request->toArray());
        return response()->json([
            'message' => 'Success',
            'pelanggan' => $pelanggan,
        ], 200);
    }

    public function APIdelete($id)
    {
        $pelanggan = Pelanggan::find($id);
        Pelanggan::destroy($id);
        return response()->json([
            'message' => 'Success',
            'pelanggan' => $pelanggan,
        ], 200);
    }
}
