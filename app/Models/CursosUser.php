<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursosUser extends Model
{
    use HasFactory;
    
    protected $table = 'cursos';
    protected $primaryKey = 'id_curso';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'duracion',
        'usuarios_id_usuario',
     ];

}
