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

        $filename = explode('.', $filename)[0] . '.webp';
            // Сохраняет миниатюру сюда
            $destinationPath = Storage::disk('public')->path($path) . '/thumbnail';
            $imgFile = Image::make($file->getRealPath())->encode('webp', 90);



            if (!is_dir($destinationPath)) mkdir($destinationPath);

            $imgFile->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/thumbnail_' . $filename);
            // Сохраняет миниатюру сюда
            $destinationPath = Storage::disk('public')->path($path) . '/small';

            $imgFile = Image::make($file->getRealPath())->encode('webp', 90);

            if (!is_dir($destinationPath)) mkdir($destinationPath);

            $imgFile->resize(250, 250, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/small_' . $filename);

            // Сохраняет миниатюру сюда
            $destinationPath = Storage::disk('public')->path($path) . '/normal';

            $imgFile = Image::make($file->getRealPath())->encode('webp', 90);

            if (!is_dir($destinationPath)) mkdir($destinationPath);

            $imgFile->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/normal_' . $filename);

            // Сохраняет среднее изображение сюда
            $destinationPath = Storage::disk('public')->path($path) . '/medium';
            $imgFile = Image::make($file->getRealPath())->encode('webp', 90);

            if (!is_dir($destinationPath)) mkdir($destinationPath);

            $imgFile->resize(900, 900, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save($destinationPath . '/medium_' . $filename);
            $destinationPath = Storage::disk('public')->path($path) . '/big';
            $imgFile = Image::make($file->getRealPath())->encode('webp', 90);

            if (!is_dir($destinationPath)) mkdir($destinationPath);

            $imgFile->resize(1440, 1440, function ($constraint) {
                $constraint->aspectRatio();
            })
                ->save($destinationPath . '/big_' . $filename);
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
            Storage::disk('public')->delete([$path . '/originals/' . $filename,
                $path . '/thumbnail/thumbnail_' . $filename,
                $path . '/small/small_' . $filename,
                $path . '/big/big_' . $filename,
                $path . '/medium/medium_' . $filename]);
            return true;
        }
        return false;
    }
}
