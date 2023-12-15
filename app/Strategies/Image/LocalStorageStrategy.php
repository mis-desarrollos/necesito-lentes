<?php

namespace App\Strategies\Image;

class LocalStorageStrategy implements ImageStorageStrategy
{
    public function saveImage($image, $basePath)
    {
        return $image->store($basePath, 'public');
    }
}
