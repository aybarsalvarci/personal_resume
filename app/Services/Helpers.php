<?php

namespace App\Services;

class Helpers
{
    public static function extractImagesFromEditor(string $editor): array
    {
        if(empty($editor)) return [];

        $dom = new \DOMDocument();
        $dom->loadHTML($editor);

        $imageTags = $dom->getElementsByTagName('img');

        $images = [];
        foreach ($imageTags as $imageTag) {
            $src = $imageTag->getAttribute('src');

            $path = preg_replace('/^.*\/storage\//', '', $src);

            $images[] = ltrim($path, '/');
        }

        return $images;
    }
}
