<?php

namespace App\Services\Antireflective;

use App\Models\Antireflective;
use App\Repositories\Antireflective\AntireflectiveRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class AntireflectiveService
{
    public function __construct(
        protected AntireflectiveRepository $antireflectiveRepository,
    ) {
    }

    public function getAllAntireflectivesPaginated($perPage = 10): LengthAwarePaginator
    {
        return $this->antireflectiveRepository->getAllPaginated($perPage);
    }

    public function createAntireflective(array $antireflectiveData)
    {
        $antireflective = $this->antireflectiveRepository->create($antireflectiveData);
        $package = $antireflectiveData['package'] ?? null;
        if ($package) {
            $antireflective->package()->sync($antireflectiveData['package']);
        }
        return $antireflective;
    }

    public function deleteImagesForAntireflective(Antireflective $antireflective)
    {
        // $antireflective->images()->get()->each(function ($image) {
        //     $imagePath = 'public/' . $image->path;
        //     Storage::delete($imagePath);
        //     $image->delete();
        // });
        // $antireflective->images()->detach();
    }

    public function getAntireflectiveById($id)
    {
        return $this->antireflectiveRepository->findById($id);
    }

    public function updateAntireflective($antireflective, $validatedData)
    {
        $antireflective->update($validatedData);
        $package = $validatedData['package'] ?? null;
        if ($package) {
            $antireflective->package()->sync($validatedData['package']);
        }
        return $antireflective;
    }

    public function deleteAntireflective($id)
    {
        return $this->antireflectiveRepository->delete($id);
    }

    public function getAntireflectiveByIds(array $ids)
    {
        return $this->antireflectiveRepository->findByIds($ids);
    }

    public function deleteImagesAssociatedWithAntireflectives(array $antireflectives): void
    {
        foreach ($antireflectives as $antireflective) {
            $this->deleteImagesForAntireflective($antireflective);
        }
    }

    public function deleteMultipleAntireflectives(array $antireflectives)
    {
        foreach ($antireflectives as $antireflective) {
            $antireflective->delete();
        }
    }
}
