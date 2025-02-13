<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = ['name', 'description', 'image', 'instrument_id'];

    /**
     * Relación con Instrument (un curso pertenece a un instrumento)
     */
    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }

    /**
     * Relación con otros modelos si es necesario (ejemplo: si tienes usuarios inscritos en el curso)
     */
    // public function students()
    // {
    //     return $this->belongsToMany(Student::class);
    // }
}
