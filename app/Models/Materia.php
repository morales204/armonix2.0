<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'materias';
    protected $primaryKey = 'id_materia';

    protected $fillable = [
        'materia',
    ];

    public function datosMateria()
    {
        return $this->hasMany(DatosMateria::class, 'materias_id_materia', 'id_materia');
    }
}

