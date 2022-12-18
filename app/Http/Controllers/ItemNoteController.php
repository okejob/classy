<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertItemNoteRequest;
use App\Http\Traits\UploadTrait;
use App\Models\Transaksi\ItemNote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemNoteController extends Controller
{
    use UploadTrait;

    //Menampilkan List Semua Note 1 Item Transaksi
    public function list($item_transaksi_id)
    {
        $item_notes = ItemNote::where('item_transaksi_id', $item_transaksi_id)->latest()->get();
        return [
            'status' => 200,
            $item_notes
        ];
    }

    //Menampilkan detail 1 Note Item Transaksi
    public function show($id)
    {
        $item_notes = ItemNote::find($id);
        return [
            'status' => 200,
            $item_notes
        ];
    }

    //Menyimpan Note ke DB
    public function insert(InsertItemNoteRequest $request)
    {
        $path = $this->upload($request, 'item_notes');
        $merged = $request->merge([
            'modified_by' => Auth::id(),
            'image_path' => url($path),
        ])->toArray();
        $item_notes = ItemNote::create($merged);
        return [
            'status' => 200,
            $item_notes
        ];
    }
}
