<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//  MICA
class Material extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function package() {
        return $this->morphToMany(Package::class, 'packageable', 'packageables');
    }
}
