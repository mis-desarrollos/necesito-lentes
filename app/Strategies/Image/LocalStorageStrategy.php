<?php

namespace App\Strategies\Image;

use Illuminate\Support\Facades\Storage;

class LocalStorageStrategy implements ImageStorageStrategy
{
    public function saveImage($image, $basePath)
    {
        return $image->store($basePath, 'public');
    }

    public function deleteImage($imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
            return true;
        }

        return false;
    }
}
