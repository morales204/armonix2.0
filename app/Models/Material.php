<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    
    protected $table = 'materiales';
    protected $primaryKey = 'id_material';

    public $timestamps = false;

    protected $fillable = [
        'nombre_material',
        'cantidad_disponible',
        'descripcion',
        'volumenes_id_volumen',
        'estatus',
     ];

}
