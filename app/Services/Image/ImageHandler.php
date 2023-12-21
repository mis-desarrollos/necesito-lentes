<?php

namespace App\Services\Image;

use App\Repositories\Image\ImageRepository;
use App\Strategies\Image\LocalStorageStrategy;
use Illuminate\Support\Collection;

class ImageHandler
{
    protected ImageService $imageService;

    public function __construct(
        LocalStorageStrategy $imageStorageStrategy,
        ImageRepository $imageRepository
    ) {
        $this->imageService = new ImageService($imageStorageStrategy, $imageRepository);
    }

    public function handleImages($model, array|null $images)
    {
        if ($images) {
            $this->imageService->saveImagesForModel($model, $images);
        }
    }

    public function handleDeleteImages($model, Collection $images)
    {
        if ($images) {
            $this->imageService->deleteImagesForModel($model, $images);
        }
    }
}

