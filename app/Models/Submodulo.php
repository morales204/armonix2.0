<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submodulo extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['nombre_sub', 'modulo_id_modulo'];

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
