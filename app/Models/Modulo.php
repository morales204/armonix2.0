<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'modulos'; // Nombre correcto de la tabla
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'tipo',
        'parent_id',
    ];

    // Relación con la categoría principal (si es una subcategoría)
    public function parent()
    {
        return $this->belongsTo(Modulo::class, 'parent_id');
    }

    // Relación con las subcategorías (si es una categoría principal)
    public function children()
    {
        return $this->hasMany(Modulo::class, 'parent_id')
            ->whereNotNull('parent_id') // Solo subcategorías
            ->where('tipo', 'Subcategoria'); // Asegúrate de que el tipo sea 'Subcategoria'
    }
    
}