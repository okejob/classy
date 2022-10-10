<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait UploadTrait
{
    public function upload(Request $request, $path, $key = 'image', $file_name = null)
    {
        $default_path = 'images/' . $path;
        $image = empty($file_name)
            ? time() . '-' . $key . '.' . $request->file($key)->extension()
            : $file_name;
        $request->file($key)->move($default_path, $image);
    }
}
