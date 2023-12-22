<?php

namespace App\Repositories\Optician;

use App\Models\Optician;
use Illuminate\Pagination\LengthAwarePaginator;

class OpticianRepository
{
    public function getAllPaginated($perPage = 15): LengthAwarePaginator
    {
        return Optician::paginate($perPage);
    }

    public function create(array $opticianData)
    {
        return Optician::create($opticianData);
    }

    public function findById($id)
    {
        return Optician::find($id);
    }

    public function findByIds(array $ids)
    {
        return Optician::whereIn('id', $ids)->get();
    }

    public function delete($id)
    {
        $optician = Optician::find($id);

        if (!$optician) {
            return false;
        }

        $optician->delete();

        return $optician;
    }

    public function deleteMultiple(array $ids)
    {
        $opticians = Optician::whereIn('id', $ids)->get();

        if ($opticians->isEmpty()) {
            return false;
        }

        $opticians->each->delete();
        return true;
    }
}
