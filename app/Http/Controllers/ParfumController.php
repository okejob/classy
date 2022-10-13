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
        Parfum::create($merged);

        return redirect()->intended(route('menu-parfum'));
    }

    public function update(InsertParfumRequest $request, $id)
    {
        $merged = $request->safe()->merge(['user_id' => Auth::id()])->toArray();
        Parfum::find($id)->update($merged);

        return redirect()->intended(route('menu-parfum'));
    }

    public function delete($id)
    {
        Parfum::destroy($id);

        return redirect()->intended(route('menu-parfum'));
    }
}
