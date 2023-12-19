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
    
    public function saveFrames(Package $package, array $frames)
    {
        foreach ($frames as $frameId) {
            $frame = Frame::find($frameId);
            if($frame){
                $package->frames()->save($frame);
            }
        }
    }
    public function saveAntireflectives(Package $package, array $antireflectives)
    {
        foreach ($antireflectives as $antireflectiveId) {
            $antireflective = Antireflective::find($antireflectiveId);
            if($antireflective){
                $package->antireflectives()->save($antireflective);
            }
        }
    }

    public function saveMaterials(Package $package, array $frames)
    {
        foreach ($frames as $frameId) {
            $material = Material::find($frameId);
            if($material){
                $package->materials()->save($material);
            }
        }
    }
}
