<?php

namespace App\Http\Services;


use Intervention\Image\ImageManagerStatic as Image;


class ImageHelper
{
    public static function insertImage($image)
    {
        $dir = public_path() . '/img/courses/';

        $imgSmall = time() . '-uploaded-' . $image->getClientOriginalName();

        $image->move($dir, $imgSmall);

        $imgNew = Image::make($dir . $imgSmall);
        $imgNew->backup();
        $imgNew->resize(400, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $imgNew->save($dir . $imgSmall);
        $imgNew->reset();

        $imgNew = Image::make($dir . $imgSmall);
        $imgNew->resize(750, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $imgBig = 'big-' . $imgSmall;
        $imgNew->save($dir . $imgBig);

        return [$imgSmall, $imgBig];
    }
}
