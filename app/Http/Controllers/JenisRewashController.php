<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertJenisRewashRequest;
use App\Models\Data\JenisRewash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisRewashController extends Controller
{
    public function insert(InsertJenisRewashRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        $jenisRewash = JenisRewash::create($merged);

        //return redirect()->intended('menu-');
    }

    public function update(InsertJenisRewashRequest $request, $id)
    {
        $jenisRewash = JenisRewash::find($id)->update($request->toArray());

        //return redirect()->intended('menu-jenis-item');
    }

    public function delete($id)
    {
        JenisRewash::destroy($id);

        //return redirect()->intended('menu-jenis-item');
    }
}
