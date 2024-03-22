<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePrestamo extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'detalle_prestamo';
    protected $primaryKey = 'id_detalle_prestamo';

    protected $fillable = [
        'cantidad_reactivo',
        'cantidad_material',
        'prestamos_id_prestamo',
        'reactivos_id_reactivo',
        'materiales_id_material'
    ];

        // Relación con la tabla 'prestamos'
        public function prestamo()
        {
            return $this->belongsTo(Prestamo::class, 'prestamos_id_prestamo', 'id_prestamo');
        }
    
        // Relación con la tabla 'reactivos'
        public function reactivo()
        {
            return $this->belongsTo(Reactivo::class, 'reactivos_id_reactivo', 'id_reactivo');
        }
    
        // Relación con la tabla 'materiales'
        public function material()
        {
            return $this->belongsTo(Material::class, 'materiales_id_material', 'id_material');
        }
}
