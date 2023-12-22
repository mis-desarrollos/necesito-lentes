<?php

namespace App\Services\Frame;

use App\Models\Frame;
use App\Models\Image;
use App\Repositories\Frame\FrameRepository;
use App\Repositories\Image\ImageRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class FrameService
{
    public function __construct(
        protected FrameRepository $frameRepository,
        protected ImageRepository $imageRepository,
    ) {
    }

    public function getAllFramesPaginated($perPage = 10): LengthAwarePaginator
    {
        return $this->frameRepository->getAllPaginated($perPage);
    }

    public function createFrame(array $frameData)
    {
        return $this->frameRepository->create($frameData);
    }

    public function savePackage($frame, $packageId)
    {
        logger($packageId);
        $frame->package()->sync($packageId);
    }

    public function getFrameById($id)
    {
        return $this->frameRepository->findById($id);
    }

    public function updateFrame($frame, $validatedData)
    {
        $frame->update($validatedData);
        return $frame;
    }

    public function deleteFrame($id)
    {
        return $this->frameRepository->delete($id);
    }

    public function getFrameByIds(array $ids)
    {
        return $this->frameRepository->findByIds($ids);
    }

    public function deleteMultipleFrames(Collection $frames)
    {
        foreach ($frames as $frame) {
            $frame->delete();
        }
    }
}
