<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

trait UploadTrait
{
    public function upload(Request $request, $path)
    {
        $quality = 0;
        $default_path = 'image\\' . $path . '\\';
        $file = $request->file('image');
        $file_name = time() . '_' . $file->getClientOriginalExtension();
        $final_path = $default_path . $file_name;
        $img = Image::make($file);
        $img->save(public_path($final_path), $quality);

        return $final_path;
    }
}
