<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = ['name', 'description', 'instrument_id', 'image'];

    /**
     * Relación con Instrument (un curso pertenece a un instrumento)
     */
    public function instrument()
    {
        return $this->belongsTo(Instrument::class);
    }

    /**
     * Relación con CourseContent (un curso tiene muchos contenidos)
     */
    public function contents()
    {
        return $this->hasMany(CourseContent::class, 'course_id');
    }
}
