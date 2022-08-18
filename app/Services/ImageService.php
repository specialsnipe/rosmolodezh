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
    public static function make($file, $path, $otherCopies = true): string
    {
        $filename = $file->hashName();

        // Сохраняет оригинал сюда
        $destinationPath = Storage::disk('public')->path($path) . '/originals';
        $file = $file->move($destinationPath, $filename);

        if ($otherCopies) {
            // Сохраняет миниатюру сюда
            $destinationPath = Storage::disk('public')->path($path) . '/thumbnail';
            $imgFile = Image::make($file->getRealPath());

            if (!is_dir($destinationPath)) mkdir($destinationPath);

            $imgFile->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/thumbnail_' . $filename);

            // Сохраняет среднее изображение сюда
            $destinationPath = Storage::disk('public')->path($path) . '/medium';
            $imgFile = Image::make($file->getRealPath());

            if (!is_dir($destinationPath)) mkdir($destinationPath);

            $imgFile->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save($destinationPath . '/medium_' . $filename);
        }

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
        if (Storage::disk('public')->exists($path . '/originals/' . $filename)) {
            Storage::disk('public')->delete([$path . '/originals/' . $filename, $path . '/thumbnail/thumbnail_' . $filename, $path . '/medium/medium_' . $filename]);
            return true;
        }
        return false;
    }
}
