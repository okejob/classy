<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertPelangganRequest;
use App\Models\Data\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function insert(InsertPelangganRequest $request)
    {
        Pelanggan::create($request);

        return redirect()->intended('data-pelanggan');
    }
}
