<?php

namespace App\Services\Image;

use App\Repositories\Image\ImageRepository;
use App\Strategies\Image\LocalStorageStrategy;

class ImageHandler
{
    protected ImageService $imageService;

    public function __construct(
        LocalStorageStrategy $imageStorageStrategy,
        ImageRepository $imageRepository
    ) {
        $this->imageService = new ImageService($imageStorageStrategy, $imageRepository);
    }

    public function handleImages($model, $images)
    {
        if ($images) {
            $this->imageService->saveImagesForModel($model, $images);
        }
    }
}

