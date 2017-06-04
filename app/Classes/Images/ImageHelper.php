<?php

namespace App\Classes\Images;

use Image;
use App\Classes\Requests\Http;

class ImageHelper
{
    public static function download($url, $absolutePath)
    {
        $http = new Http($url);
        $http->downloadImage($absolutePath);
    }

    public static function downloadAndResize($url, $absolutePath, $width, $height)
    {
        ImageHelper::download($url, $absolutePath);
        Image::make($absolutePath)->fit($width, $height)->save();
    }
}
