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
        JenisRewash::create($merged);

        //return redirect()->intended(route(''));
    }

    public function update(InsertJenisRewashRequest $request, $id)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        JenisRewash::find($id)->update($merged);

        //return redirect()->intended(route(''));
    }

    public function delete($id)
    {
        JenisRewash::destroy($id);

        //return redirect()->intended(route(''));
    }
}
