<?php
/**
 * Created by PhpStorm.
 * User: Maximum Code
 * Date: 08.02.2019
 * Time: 15:22
 */

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as InterventionImage;

trait UploadeAvatar
{
    public function uploadFile($file, $slug)
    {
        $image = InterventionImage::make($file);
        $path = $slug . DIRECTORY_SEPARATOR . date('FY') . DIRECTORY_SEPARATOR;

        $filename = time();
        // Make sure the filename does not exist, if it does, just regenerate
        while (Storage::disk('public')->exists($path . $filename . ('.jpg'))) {

            $filename .= '-' . Str::random(20);
        }

        $fullPath = $path . $filename . '.jpg';

        Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string)$image->encode('jpg', 75), 'public');

        $filename = $fullPath;

        return $filename;
    }
}