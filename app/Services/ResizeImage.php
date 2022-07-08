<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ResizeImage
{
    /**
     * @param $file
     * @param $path
     * @param $width
     * @param $height
     * @return string
     */
    public static function make($file, $path, $width, $height): string
    {
        $filename = time() . "_" . $file->getClientOriginalName();

        $destinationPath = Storage::path('public/'.$path) . '/thumbnail';
        // Сохраняет миниатюру сюда
        $imgFile = Image::make($file->getRealPath());
        $imgFile->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();})
            ->save($destinationPath.'/'.$filename);

        // Сохраняет оригинал сюда
        $destinationPath = Storage::path('public/'.$path) . '/originals';
        $file->move($destinationPath, $filename);

        return $filename;
    }
}
