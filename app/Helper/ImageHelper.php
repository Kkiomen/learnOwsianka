<?php

namespace App\Helper;

class ImageHelper
{
    public static function getImage($filename): string
    {
        if(app()->environment('production')){
            return 'https://oatllo.pl/' . 'storage/image-uploads/'. $filename;
        }

        return asset('storage/image-uploads/'. $filename);
    }
}
