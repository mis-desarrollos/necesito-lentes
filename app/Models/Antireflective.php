<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antireflective extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    public function package() {
        return $this->morphToMany(Package::class, 'packageable', 'packageables');
    }
}
