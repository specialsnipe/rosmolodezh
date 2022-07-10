<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageService
{
    /**
     * Make image on storage path and make the thumbnail
     *
     * @param $file
     * @param $path
     * @return string
     */
    public static function make($file, $path): string
    {
        $filename = $file->hashName();
        // Сохраняет оригинал сюда
        $destinationPath = Storage::path('public/'.$path) . '/originals';
        $file->move($destinationPath, $filename);

        self::resize($file, $path . '/thumbnail', 150, 150);
        self::resize($file, $path . '/medium', 500, 500);

        return $filename;
    }

    /**
     * Make a resize Image
     *
     * @param $file
     * @param $path
     * @param $width
     * @param $height
     * @return bool
     */
    public static function resize($file, $path, $width, $height): bool
    {
        $filename = $file->hashName();
        $destinationPath = Storage::path('public/'.$path);
        // Сохраняет миниатюру сюда
        $imgFile = Image::make($file->getRealPath());
        $imgFile->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();})
            ->save($destinationPath.'/'.$filename);

        return true;
    }
}
