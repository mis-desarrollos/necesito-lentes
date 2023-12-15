<?php

namespace App\Services\Image;

use App\Repositories\Image\ImageRepository;
use App\Strategies\Image\ImageStorageStrategy;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImageService
{
    public function __construct(
        protected ImageStorageStrategy $imageStorageStrategy,
        protected ImageRepository $imageRepository,
    ) {
    }

    /**
     * Saves images for a given model.
     *
     * @param mixed $model The model to associate images with.
     * @param array $images Array of images to be saved.
     *
     * @throws \Exception If there's an error during image saving process.
     */
    public function saveImagesForModel($model, array $images)
    {
        try {
            DB::beginTransaction(); // Begin a database transaction.

            foreach ($images as $image) {
                // Save each image using the image storage strategy.
                $path = $this->imageStorageStrategy->saveImage($image, 'images/frames');

                // Save the image metadata using the image repository.
                $imageModel = $this->imageRepository->save(['path' => $path]);

                // Associate the saved image with the model.
                $model->images()->save($imageModel);
            }

            DB::commit(); // Commit the transaction.
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of an exception.

            // Log the error message.
            Log::error('Error saving images: ' . $e->getMessage());

            throw $e; // Re-throw the exception for handling at a higher level.
        }
    }
}
