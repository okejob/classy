<?php

namespace App\Http\Controllers;

use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DiskonController extends Controller
{
    public function insert(Request $request)
    {
        Diskon::create([
            'code' => $request->code,
            'description' => $request->description,
            'expired' => Date::createFromFormat('dd-mm-yyyy', $request->expired_date),
            'nominal' => $request->nominal
        ]);
    }
}
