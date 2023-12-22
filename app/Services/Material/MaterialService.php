<?php

namespace App\Services\Material;

use App\Models\Material;
use App\Repositories\Material\MaterialRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class MaterialService
{
    public function __construct(
        protected MaterialRepository $materialRepository,
    ) {
    }

    public function getAllMaterialsPaginated($perPage = 10): LengthAwarePaginator
    {
        return $this->materialRepository->getAllPaginated($perPage);
    }

    public function createMaterial(array $materialData)
    {
        $material = $this->materialRepository->create($materialData);
        $package = $materialData['package'] ?? null;
        if ($package) {
            $material->package()->sync($materialData['package']);
        }
        return $material;
    }

    public function deleteImagesForMaterial(Material $material)
    {
        // $material->images()->get()->each(function ($image) {
        //     $imagePath = 'public/' . $image->path;
        //     Storage::delete($imagePath);
        //     $image->delete();
        // });
        // $material->images()->detach();
    }

    public function getMaterialById($id)
    {
        return $this->materialRepository->findById($id);
    }

    public function updateMaterial($material, $validatedData)
    {
        $material->update($validatedData);
        $package = $validatedData['package'] ?? null;
        if ($package) {
            $material->package()->sync($validatedData['package']);
        }
        return $material;
    }

    public function deleteMaterial($id)
    {
        return $this->materialRepository->delete($id);
    }

    public function getMaterialByIds(array $ids)
    {
        return $this->materialRepository->findByIds($ids);
    }

    public function deleteImagesAssociatedWithMaterials(array $materials): void
    {
        foreach ($materials as $material) {
            $this->deleteImagesForMaterial($material);
        }
    }

    public function deleteMultipleMaterials(array $materials)
    {
        foreach ($materials as $material) {
            $material->delete();
        }
    }
}
