<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPenerimaRequest;
use App\Http\Traits\UploadTrait;
use App\Models\Transaksi\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    use UploadTrait;

    public function insert(InsertPenerimaRequest $request)
    {
        $path = $this->upload($request, 'penerima');
        $merged = $request->safe()->merge([
            'modified_by' => Auth::id(),
            'foto_penerima' => $path,
            ])->toArray();
        $penerima = Penerima::create($merged);
        return [
            'status' => 200,
            $penerima
        ];
    }
}
