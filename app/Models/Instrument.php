<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    // Los campos que se pueden llenar
    protected $fillable = ['name', 'instrument_type_id', 'image'];

    /**
     * Relación con InstrumentType (un instrumento pertenece a un tipo de instrumento)
     */
    public function instrumentType()
    {
        return $this->belongsTo(InstrumentType::class, 'instrument_type_id');
    }

    /**
     * Relación con Course (un instrumento puede tener varios cursos)
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'instrument_id');
    }
    
}
