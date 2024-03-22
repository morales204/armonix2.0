<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volumen extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'volumenes';
    protected $primaryKey = 'id_volumen';

    protected $fillable = [
        'volumen',
        'estatus'
    ];
}
