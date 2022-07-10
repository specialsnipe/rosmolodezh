<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
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
        $destinationPath = Storage::disk('public')->path($path) . '/originals'; ;
        $file = $file->move($destinationPath, $filename);

        // Сохраняет миниатюру сюда
        $destinationPath = Storage::disk('public')->path($path) . '/thumbnail' ;
//        dd($destinationPath);
        $imgFile = Image::make($file->getRealPath());
//        dd($imgFile);mkdir
        if (!is_dir($destinationPath)) mkdir($destinationPath);
        $imgFile->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' .$filename);

        // Сохраняет среднее изображение сюда
        $destinationPath = Storage::disk('public')->path($path) . '/medium' ;
        if (!is_dir($destinationPath)) mkdir($destinationPath);
        $imgFile = Image::make($file->getRealPath());
        $imgFile->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();})
            ->save($destinationPath.'/'.$filename);
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
    public static function deleteOld($filename, $path): bool
    {
        Storage::disk('public')->delete([$path .'/originals/' . $filename, $path .'/thumbnail/' . $filename, $path .'/medium/' . $filename]);
        return true;
    }
}
