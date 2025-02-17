<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $table = 'catalogs';
    protected $fillable = ['name'];

    // Definir la relación con InstrumentType
    public function instrumentTypes()
    {
        return $this->hasMany(InstrumentType::class, 'catalog_id'); 
    }
}
