<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPaketDepositRequest;
use App\Models\Paket\PaketDeposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaketDepositController extends Controller
{
    public function insert(InsertPaketDepositRequest $request)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        PaketDeposit::create($merged);

        return redirect()->intended(route('menu-paket-deposit'));
    }

    public function show($id)
    {
        $paket_deposit = PaketDeposit::find($id);
        return [
            'status' => 200,
            $paket_deposit,
        ];
    }

    public function update(InsertPaketDepositRequest $request, $id)
    {
        $merged = $request->merge(['modified_by' => Auth::id()])->toArray();
        PaketDeposit::find($id)->update($merged);

        return redirect()->intended(route('menu-paket-deposit'));
    }

    public function delete($id)
    {
        PaketDeposit::destroy($id);

        return redirect()->intended(route('menu-paket-deposit'));
    }
}
