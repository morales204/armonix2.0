<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instrument extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type_id']; // Asegúrate de que type_id esté incluido

    // Define la relación con InstrumentType
    public function instrumentType()
    {
        return $this->belongsTo(InstrumentType::class, 'type_id');
    }
}
