<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packageable extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'packageable_id', 'packageable_type'];
}
