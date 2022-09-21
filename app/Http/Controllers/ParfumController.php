<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertParfumRequest;
use App\Models\Data\Parfum;
use Illuminate\Http\Request;

class ParfumController extends Controller
{
    public function insert(InsertParfumRequest $request)
    {
        Parfum::create([$request]);

        return redirect()->intended('data-parfum');
    }
}
