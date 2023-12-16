<?php

namespace App\Repositories\Material;

use App\Models\Material;
use Illuminate\Pagination\LengthAwarePaginator;

class MaterialRepository
{
    public function getAllPaginated($perPage = 15): LengthAwarePaginator
    {
        return Material::paginate($perPage);
    }

    public function create(array $materialData)
    {
        return Material::create($materialData);
    }

    public function findById($id)
    {
        return Material::find($id);
    }

    public function findByIds(array $ids)
    {
        return Material::with('images')->whereIn('id', $ids)->get();
    }

    public function delete($id)
    {
        $material = Material::find($id);

        if (!$material) {
            return false;
        }

        $material->delete();

        return $material;
    }

    public function deleteMultiple(array $ids)
    {
        $materials = Material::whereIn('id', $ids)->get();

        if ($materials->isEmpty()) {
            return false;
        }

        $materials->each->delete();
        return true;
    }
}
