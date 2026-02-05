<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    public static function upload(UploadedFile $file, string $path, ?int $width = null) : string
    {
        $image = Image::read($file);

        if($width)
        {
            $encodedImage = $image->scaleDown($width);
        }

        $encodedImage = $image->toWebp(80);

        $fileName = Str::uuid() . '.webp';
        $fullPath = trim($path, '/') . '/' . $fileName;

        Storage::disk('public')->put($fullPath, $encodedImage);
        return $fullPath;
    }
}
