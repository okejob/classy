<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait UploadTrait
{
    //Function Global untuk mengupload Gambar
    public function upload(Request $request, $path)
    {
        // $quality = 70;
        $default_path = 'image/' . $path . '/';
        $file = $request->file('image');
        if ($file) {
            // $file_name = time() . '.' . $file->getClientOriginalExtension();
            // $final_path = $default_path . $file_name;
            // $img = Image::make($file);
            // $img->save($final_path, $quality);

            // return $final_path;
            $file_url = Storage::disk('digitalocean')->put($default_path, $file, $file);
            $url = Storage::disk('digitalocean')->url($file_url);
            return $url;
        }
        return null;
    }
}
