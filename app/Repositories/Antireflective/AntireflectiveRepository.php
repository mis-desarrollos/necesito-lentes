<?php

namespace App\Repositories\Antireflective;

use App\Models\Antireflective;
use Illuminate\Pagination\LengthAwarePaginator;

class AntireflectiveRepository
{
    public function getAllPaginated($perPage = 15): LengthAwarePaginator
    {
        return Antireflective::paginate($perPage);
    }

    public function create(array $antireflectiveData)
    {
        return Antireflective::create($antireflectiveData);
    }

    public function findById($id)
    {
        return Antireflective::find($id);
    }

    public function findByIds(array $ids)
    {
        return Antireflective::with('images')->whereIn('id', $ids)->get();
    }

    public function delete($id)
    {
        $antireflective = Antireflective::find($id);

        if (!$antireflective) {
            return false;
        }

        $antireflective->delete();

        return $antireflective;
    }

    public function deleteMultiple(array $ids)
    {
        $antireflectives = Antireflective::whereIn('id', $ids)->get();

        if ($antireflectives->isEmpty()) {
            return false;
        }

        $antireflectives->each->delete();
        return true;
    }
}
