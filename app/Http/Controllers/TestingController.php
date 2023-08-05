<?php

namespace App\Http\Controllers;

use App\Models\Testing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestingController extends Controller
{
    public function test(Request $request)
    {
        $emails = Testing::select('bcc')
            ->groupBy('bcc')
            ->get();
        return $emails;
    }
}
