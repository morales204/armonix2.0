<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reactivo extends Model
{
    use HasFactory;

    protected $table = 'reactivos';
    protected $primaryKey = 'id_reactivo';

    public $timestamps = false;

    protected $fillable = [
        'nombre_reactivo',
        'cantidad_disponible',
        'hoja_seguridad',
        'nomenclatura',
        'fecha_adquisicion',
        'fecha_caducidad',
        'familias_id_familia',
        'nivel_peligrosidad_id_nivel_peligrosidad',
        'condiciones_almacenamiento_id_condiciones_almacenamiento',
        'estatus'
    ];
}
