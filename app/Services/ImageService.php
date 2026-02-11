<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class ImageService
{
    public static function uploadWithEncoding(UploadedFile $file, string $path, ?int $width = null, ?string $format = 'webp'): string
    {
        try {
            $image = Image::read($file);

            if ($width) {
                $encodedImage = $image->scaleDown($width);
            }

            $format = $format == null ? $file->extension() : $format;

            $encodedImage = $image->encodeByExtension($format, quality:80);

        } catch (\Exception $e) {
            Log::error('Görsel işlenirken bir hata oluştu: ' . $e->getMessage(), $e->getTrace());
        }

        try {
            $fileName = Str::uuid() . '.' . $format;
            $fullPath = trim($path, '/') . '/' . $fileName;

            Storage::disk('public')->put($fullPath, $encodedImage);
        } catch (\Exception $e) {
            Log::error('Görsel yüklenirken bir hata oluştu: ' . $e->getMessage(), $e->getTrace());
        }

        return $fullPath;
    }

    public static function uploadWithoutEncoding(UploadedFile $file, string $path, ?int $width = null): string
    {
        try {
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = trim($path, '/');

            Storage::disk('public')->putFileAS($path, $file, $fileName);
            return $path . "/" . $fileName;
        } catch (\Exception $e) {
            Log::error('Görsel yüklenirken bir hata oluştu: ' . $e->getMessage(), $e->getTrace());
        }

        return "";
    }
}
