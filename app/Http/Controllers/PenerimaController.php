<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPenerimaRequest;
use App\Models\Transaksi\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    public function findOrCreate(InsertPenerimaRequest $request)
    {
        $merged = $request->safe()->merge(['modified_by' => Auth::id()])->toArray();
        $penerima = Penerima::create($merged);
        return [
            'status' => 200,
            $penerima
        ];
    }
}
