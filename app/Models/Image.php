<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Image extends Model
{
    protected $fillable = [
        'path',
        'disk',
        'key',
    ];

    public function frames(): MorphToMany
    {
        return $this->morphedByMany(Frame::class, 'imageable');
    }
}
