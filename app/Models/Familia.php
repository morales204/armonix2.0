<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = 'familias';
    protected $primaryKey = 'id_familia';

    protected $fillable = [
        'tipo',
        'estatus'
    ];

}
