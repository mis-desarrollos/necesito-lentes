<?php

namespace App\Services\Package;

use App\Models\Antireflective;
use App\Models\Frame;
use App\Models\Material;
use App\Models\Package;
use App\Repositories\Image\ImageRepository;
use App\Repositories\Package\PackageRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PackageService
{
    public function __construct(
        protected PackageRepository $packageRepository,
        protected ImageRepository $imageRepository,
    ) {
    }

    public function getAllPackagesPaginated($perPage = 10): LengthAwarePaginator
    {
        return $this->packageRepository->getAllPaginated($perPage);
    }

    public function createPackage(array $packageData)
    {
        return $this->packageRepository->create($packageData);
    }

    public function getPackageById($id)
    {
        return $this->packageRepository->findById($id);
    }

    public function updatePackage($package, $validatedData)
    {
        $package->update($validatedData);
        return $package;
    }

    public function saveFrames(Package $package, array $frameIds)
    {
        $package->frames()->sync($frameIds);
    }

    public function saveAntireflectives(Package $package, array $antireflectivesIds)
    {
        $package->antireflectives()->sync($antireflectivesIds);
    }

    public function saveMaterials(Package $package, array $materialsIds)
    {
        $package->materials()->sync($materialsIds);
    }
}
