<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use Opcodes\LogViewer\Logs\Log;

class ImageService
{
    public static function upload(UploadedFile $file, string $path, ?int $width = null): string
    {
        try {
            $image = Image::read($file);

            if ($width) {
                $encodedImage = $image->scaleDown($width);
            }

            $encodedImage = $image->toWebp(80);
        } catch (\Exception $e) {
            Log::error('Görsel işlenirken bir hata oluştu: ' . $e->getMessage(), $e->getTrace());
        }

        try {
            $fileName = Str::uuid() . '.webp';
            $fullPath = trim($path, '/') . '/' . $fileName;

            Storage::disk('public')->put($fullPath, $encodedImage);
        } catch (\Exception $e) {
            Log::error('Görsel yüklenirken bir hata oluştu: ' . $e->getMessage(), $e->getTrace());
        }

        return $fullPath;
    }
}
