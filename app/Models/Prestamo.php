<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'prestamos';
    protected $primaryKey = 'id_prestamo';

    protected $fillable = [
        'datos_materia_id_datos_materia',
        'fecha_hora_inicio',
        'fecha_hora_fin',
        'no_practica',
        'titulo_practica',
        'fecha_prestamo',
        'status_id_status',
        'laboratorios_id_laboratorio',
        'usuarios_id_usuario',
        'encargado_id_usuario',
    ];

    public function detallesPrestamo()
    {
        return $this->hasMany(DetallePrestamo::class, 'prestamos_id_prestamo', 'id_prestamo');
    }

    public function datosMateria()
    {
        return $this->belongsTo(DatosMateria::class, 'datos_materia_id_datos_materia', 'id_datos_materia');
    }

}
