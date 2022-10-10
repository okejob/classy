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
        $outlet = Outlet::create($merged);

        return redirect()->intended(route('setting-outlet'));
    }

    public function update(InsertOutletRequest $request, $id)
    {
        $outlet = Outlet::find($id)->update($request->toArray());

        return redirect()->intended(route('setting-outlet'));
    }

    public function delete($id)
    {
        Outlet::destroy($id);

        return redirect()->intended(route('setting-outlet'));
    }

    //API
    public function APIshow()
    {
        $outlet = Outlet::get();
        return response()->json([
            'message' => 'Success',
            'outlet' => $outlet,
        ], 200);
    }

    public function APIinsert(InsertOutletRequest $request)
    {
        $merged = $request->safe()->merge(['user_id' => 1])->toArray();
        $outlet = Outlet::create($merged);

        return response()->json([
            'message' => 'Success',
            'outlet' => $outlet,
        ], 200);
    }

    public function APIupdate(InsertOutletRequest $request, $id)
    {
        $outlet = Outlet::find($id)->update($request->toArray());
        return response()->json([
            'message' => 'Success',
            'outlet' => $outlet,
        ], 200);
    }

    public function APIdelete($id)
    {
        $outlet = Outlet::find($id);
        Outlet::destroy($id);
        return response()->json([
            'message' => 'Success',
            'outlet' => $outlet,
        ], 200);
    }
}
