<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_mod'];

    public function submodulos()
    {
        return $this->hasMany(Submodulo::class);
    }
}
