<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertJenisItemRequest;
use App\Models\Data\JenisItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisItemController extends Controller
{
    public function insert(InsertJenisItemRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        $jenisItem = JenisItem::create($merged);

        return redirect()->intended(route('menu-jenis-item'));
    }

    public function update(InsertJenisItemRequest $request, $id)
    {
        $jenisItem = JenisItem::find($id)->update($request->toArray());

        return redirect()->intended(route('menu-jenis-item'));
    }

    public function delete($id)
    {
        JenisItem::destroy($id);

        return redirect()->intended(route('menu-jenis-item'));
    }

    //API
    public function APIshow()
    {
        $jenisItem = JenisItem::get();
        return response()->json([
            'message' => 'Success',
            'jenis_item' => $jenisItem,
        ], 200);
    }

    public function APIinsert(InsertJenisItemRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => 1])->toArray();
        $jenisItem = JenisItem::create($merged);

        return response()->json([
            'message' => 'Success',
            'jenis_item' => $jenisItem,
        ], 200);
    }

    public function APIupdate(InsertJenisItemRequest $request, $id)
    {
        $jenisItem = JenisItem::find($id)->update($request->toArray());
        return response()->json([
            'message' => 'Success',
            'jenis_item' => $jenisItem,
        ], 200);
    }

    public function APIdelete($id)
    {
        $jenisItem = JenisItem::find($id);
        JenisItem::destroy($id);
        return response()->json([
            'message' => 'Success',
            'jenis_item' => $jenisItem,
        ], 200);
    }
}
