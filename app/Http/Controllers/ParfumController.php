<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertParfumRequest;
use App\Models\Data\Parfum;
use App\Models\Update;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParfumController extends Controller
{
    public function insert(InsertParfumRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()]);
        $parfum = Parfum::create([$merged]);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'insert',
            'table' => 'parfums',
            'affected_id' => $parfum->id,
        ]);

        return redirect()->intended('menu-parfum');
    }

    public function delete($id)
    {
        Parfum::destroy($id);
        Update::create([
            'user_id' => Auth::id(),
            'type' => 'delete',
            'table' => 'parfums',
            'affected_id' => $id,
        ]);

        return redirect()->intended('menu-parfum');
    }

    //API
    public function APIshow()
    {
        $parfum = Parfum::get();
        return response()->json([
            'message' => 'Success',
            'parfum' => $parfum,
        ], 200);
    }

    public function APIinsert(InsertParfumRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => 1])->toArray();
        $parfum = Parfum::create($merged);

        return response()->json([
            'message' => 'Success',
            'parfum' => $parfum,
        ], 200);
    }

    public function APIupdate(InsertParfumRequest $request, $id)
    {
        $parfum = Parfum::find($id)->update($request->toArray());
        return response()->json([
            'message' => 'Success',
            'parfum' => $parfum,
        ], 200);
    }

    public function APIdelete($id)
    {
        $parfum = Parfum::find($id);
        Parfum::destroy($id);
        return response()->json([
            'message' => 'Success',
            'parfum' => $parfum,
        ], 200);
    }
}
