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
        dd($request);
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        Pelanggan::create($merged);

        return redirect()->intended(route('menu-pelanggan'));
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::find($id);
        return [
            'status' => 200,
            $pelanggan,
        ];
    }

    public function update(InsertPelangganRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        Pelanggan::find($id)->update($merged);

        return redirect()->back();
    }

    public function delete($id)
    {
        Pelanggan::destroy($id);

        return redirect()->intended(route('menu-pelanggan'));
    }

    public function detailPelanggan($id_pelanggan) {
        return view(
            'pages.data.DetailPelanggan',
            [
                'pelanggan' => Pelanggan::where('id', $id_pelanggan)->first(),
            ]
        );
    }

    public function search(Request $request)
    {
        $conditions = [];
        if ($request->filter === 'nama') {
            $conditions[] = function ($q) use ($request) {
                return $q->where('nama', 'like', '%' . $request->key . '%');
            };
        } else if ($request->filter === 'no_id') {
            $conditions[] = function ($q) use ($request) {
                return $q->where('no_id', 'like', '%' . $request->key . '%');
            };
        } else if ($request->filter === 'telephone') {
            $conditions[] = function ($q) use ($request) {
                return $q->where('telephone', 'like', '%' . $request->key . '%');
            };
        } else if ($request->filter === 'email') {
            $conditions[] = function ($q) use ($request) {
                return $q->where('email', 'like', '%' . $request->key . '%');
            };
        }

        $pelanggan = Pelanggan::when($request->filled('key'), function ($q) use ($conditions) {
            return tap($q, function ($q) use ($conditions) {
                foreach ($conditions as $condition) {
                    $q->when(true, $condition);
                }
            });
        })->orderBy('created_at', 'asc')->paginate($request->paginate);

        return view('components.tablePelanggan', [
            'pelanggans' => $pelanggan,
        ]);
    }
}
