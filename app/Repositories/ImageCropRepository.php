<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

class ImageCropRepository
{
    public function handle($file)
    {
        $image_size = config('croppie.image.size');
        $image_quality = config('croppie.image.quality');
        $directory = config('croppie.directory');

        $path = $directory.DIRECTORY_SEPARATOR.date('FY').DIRECTORY_SEPARATOR;

        $filename = $this->generateFileName($file, $path);

        $image = InterventionImage::make($file);
        $image->resize(config('croppie.image.size.width'), config('croppie.image.size.height'));

//        if($image_size['width'] != $image->width() || $image_size['width'] != $image->width()){
//            return null;
//        }

        $image = $image->encode($file->getClientOriginalExtension(), $image_quality);

        $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

        Storage::disk(config('croppie.storage'))->put($fullPath, (string) $image);

        return $fullPath;
    }

    protected function generateFileName($file, $path)
    {
        $filename = Str::random(20);

        while (Storage::disk(config('croppie.storage'))->exists($path.$filename.'.'.$file->getClientOriginalExtension())) {
            $filename = Str::random(20);
        }
        return $filename;
    }

    public static function deleteFileIfExists($path)
    {
        if (Storage::disk(config('croppie.storage'))->exists($path)) {
            Storage::disk(config('croppie.storage'))->delete($path);
        }
    }
}
