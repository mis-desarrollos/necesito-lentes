<?php

namespace App\Repositories\Package;

use App\Models\Package;
use Illuminate\Pagination\LengthAwarePaginator;

class PackageRepository
{
    public function getAllPaginated($perPage = 15): LengthAwarePaginator
    {
        return Package::paginate($perPage);
    }

    public function create(array $packageData)
    {
        return Package::create($packageData);
    }
}
