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

}
