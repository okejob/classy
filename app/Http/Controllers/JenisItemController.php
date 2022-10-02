<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertJenisItemRequest;
use App\Models\Data\JenisItem;
use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisItemController extends Controller
{
    public function insert(InsertJenisItemRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()]);
        $item = JenisItem::create($merged);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'insert',
            'table' => 'jenis_items',
            'affected_id' => $item->id,
        ]);

        return redirect()->intended('menu-jenis-item');
    }

    public function delete($id)
    {
        JenisItem::destroy($id);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'delete',
            'table' => 'jenis_items',
            'affected_id' => $id,
        ]);

        return redirect()->intended('menu-jenis-item');
    }
}