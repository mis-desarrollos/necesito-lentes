<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function images()
    {
        return $this->morphToMany(Image::class, 'imageable');
    }

    public function package()
    {
        return $this->morphToMany(Package::class, 'packageable', 'packageables');
    }
}
