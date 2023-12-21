<?php

namespace App\Strategies\Image;

interface ImageStorageStrategy
{
    public function saveImage($image, $basePath);
    public function deleteImage($path);
}