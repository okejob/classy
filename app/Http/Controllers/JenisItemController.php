<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertJenisItemRequest;
use App\Models\Data\JenisItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisItemController extends Controller
{

    //Mencari Jenis Item dengan Key Nama atau Nama Kategori
    public function find(Request $request)
    {
        return view('components.tableJenisItem',[
            'items' => JenisItem::where(function ($query) use ($request) {
                $query->where('nama', 'like', "%{$request->key}%")
                    ->orWhereHas('kategori', function ($q) use ($request) {
                        $q->where('nama', 'like', "%{$request->key}%");
                    });
            })->orderBy("nama", "asc")->paginate($request->paginate),
        ]);
    }

    //Menyimpan Jenis Item ke DB
    public function insert(InsertJenisItemRequest $request)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        JenisItem::create($merged);

        return redirect()->intended(route('menu-jenis-item'));
    }

    //Menampilkan Detail Jenis Item
    public function show($id)
    {
        $jenis_item = JenisItem::find($id);
        return [
            'status' => 200,
            $jenis_item,
        ];
    }

    //Update Jenis Item
    public function update(InsertJenisItemRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        JenisItem::find($id)->update($merged);

        return redirect()->intended(route('menu-jenis-item'));
    }

    //Delete Jenis Item
    public function delete($id)
    {
        JenisItem::destroy($id);

        return redirect()->intended(route('menu-jenis-item'));
    }
}
