<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertItemRequest;
use App\Models\Data\Item;
use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function insert(InsertItemRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()]);
        $item = Item::create($merged);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'insert',
            'table' => 'item',
            'affected_id' => $item->id,
        ]);

        return redirect()->intended('menu-item');
    }

    public function delete($id)
    {
        Item::destroy($id);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'delete',
            'table' => 'item',
            'affected_id' => $id,
        ]);

        return redirect()->intended('menu-item');
    }
}
