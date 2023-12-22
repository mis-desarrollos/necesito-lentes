<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optician extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'web',
        'address',
        'lng',
        'lat',
        'instagram',
        'facebook',
        'twitter',
    ];

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }
}
