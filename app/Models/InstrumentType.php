<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstrumentType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    // Relación con los instrumentos (si existe)
    public function instruments()
    {
        return $this->hasMany(Instrument::class);
    }
}
