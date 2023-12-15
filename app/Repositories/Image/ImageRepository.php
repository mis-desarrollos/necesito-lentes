<?php

namespace App\Repositories\Image;

use App\Models\Image;

class ImageRepository
{
    public function save(array $data)
    {
        return new Image($data);
    }
}
