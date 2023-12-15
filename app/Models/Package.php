<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function antireflectives() {
        return $this->morphedByMany(Antireflective::class, 'packageable');
    }
    
    // Micas
    public function materials() {
        return $this->morphedByMany(Material::class, 'packageable');
    }
    
    public function frames() {
        return $this->morphedByMany(Frame::class, 'packageable');
    }
}
