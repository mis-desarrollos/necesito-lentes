<?php

namespace App\Services\Optician;

use App\Models\Optician;
use App\Repositories\Optician\OpticianRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class OpticianService
{
    public function __construct(
        protected OpticianRepository $opticianRepository,
    ) {
    }

    public function getAllOpticiansPaginated($perPage = 10): LengthAwarePaginator
    {
        return $this->opticianRepository->getAllPaginated($perPage);
    }

    public function createOptician(array $opticianData)
    {
        $optician = $this->opticianRepository->create($opticianData);
        $optician->package()->sync($opticianData['package']);
        return $optician;
    }

    public function deleteImagesForOptician(Optician $optician)
    {
        // $optician->images()->get()->each(function ($image) {
        //     $imagePath = 'public/' . $image->path;
        //     Storage::delete($imagePath);
        //     $image->delete();
        // });
        // $optician->images()->detach();
    }

    public function getOpticianById($id)
    {
        return $this->opticianRepository->findById($id);
    }

    public function updateOptician($optician, $validatedData)
    {
        $optician->update($validatedData);
        $optician->package()->sync($validatedData['package']);
        return $optician;
    }

    public function deleteOptician($id)
    {
        return $this->opticianRepository->delete($id);
    }

    public function getOpticianByIds(array $ids)
    {
        return $this->opticianRepository->findByIds($ids);
    }

    public function deleteImagesAssociatedWithOpticians(array $opticians): void
    {
        foreach ($opticians as $optician) {
            $this->deleteImagesForOptician($optician);
        }
    }

    public function deleteMultipleOpticians(array $opticians)
    {
        foreach ($opticians as $optician) {
            $optician->delete();
        }
    }
}
