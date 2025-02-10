<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class NotasPremium
 *
 * @property $id_notaP
 * @property $nombre_notaP
 * @property $contenido_notaP
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class NotasPremium extends Model
{
    protected $table = 'notasPremium';
    protected $primaryKey = 'id_notaP';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_notaP', 'nombre_notaP', 'contenido_notaP'];


}
