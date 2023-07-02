<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestingController extends Controller
{
    public function test(Request $request, $path)
    {
        $default_path = 'image/' . $path;
        $file = $request->file('image');
        if ($file) {
            $test = Storage::disk('digitalocean')->put($default_path, $file, 'public');
            return Storage::disk('digitalocean')->url($test);
        }
        return null;
    }
}
