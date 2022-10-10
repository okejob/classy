<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertParfumRequest;
use App\Models\Data\Parfum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParfumController extends Controller
{
    public function insert(InsertParfumRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        $parfum = Parfum::create([$merged]);

        return redirect()->intended(route('menu-parfum'));
    }

    public function update(InsertParfumRequest $request, $id)
    {
        $parfum = Parfum::find($id)->update($request->toArray());

        return redirect()->intended(route('menu-parfum'));
    }

    public function delete($id)
    {
        Parfum::destroy($id);

        return redirect()->intended(route('menu-parfum'));
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
