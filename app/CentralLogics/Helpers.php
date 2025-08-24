<?php

namespace App\CentralLogics;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Image;

class Helpers
{
    /**
    * upload
    * @param dir
    * @param format
    * @param image
    * @return imageName
    */
    public static function upload(string $dir, string $format, $image = null)
    {

  if ($image != null) {
            $imageName = strtotime(Carbon::now()) . uniqid() . "." . $format;
            if (!Storage::disk('public_uploads')->exists($dir)) {
                Storage::disk('public_uploads')->makeDirectory($dir);
            }
            if($format=='png' || $format=='jpg' || $format=='jpeg') {
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(1000, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::disk('public_uploads')->put($dir . $imageName, $image_resize->stream());
            }else
            {
                Storage::disk('public_uploads')->put($dir . $imageName, file_get_contents($image));

            }
            return $imageName;

        }
    }

    /**
    * update
    *
    */
    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        if ($image == null) {
            return $old_image;
        }
        if (Storage::disk('public_uploads')->exists($dir . $old_image)) {
            Storage::disk('public_uploads')->delete($dir . $old_image);
        }
        $imageName = Helpers::upload($dir, $format, $image);
        return $imageName;
    }

    /**
    * delete
    *
    */
    public static function delete(string $dir, $old_image)
    {
        if (Storage::disk('public_uploads')->exists($dir . $old_image)) {
            Storage::disk('public_uploads')->delete($dir . $old_image);
        }
        return true;
    }
}
