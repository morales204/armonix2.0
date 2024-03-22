<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosMateria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'datos_materia';
    protected $primaryKey = 'id_datos_materia';

    protected $fillable = [
        'materias_id_materia',
        'unidad_tematica',
        'introduccion',
        'objetivo',
        'grado_grupo',
        'carreras_id_carrera'
    ];

}
