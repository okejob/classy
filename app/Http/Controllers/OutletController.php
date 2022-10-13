<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertOutletRequest;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutletController extends Controller
{
    public function insert(InsertOutletRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        Outlet::create($merged);

        return redirect()->intended(route('setting-outlet'));
    }

    public function update(InsertOutletRequest $request, $id)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        Outlet::find($id)->update($merged);

        return redirect()->intended(route('setting-outlet'));
    }

    public function delete($id)
    {
        Outlet::destroy($id);

        return redirect()->intended(route('setting-outlet'));
    }
}
