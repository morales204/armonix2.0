<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable// Implementa la interfaz
{

    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $fillable = [
        'nombre_completo',
        'telefono',
        'correo',
        'username',
        'password',
        'roles_id_rol',
        'remember_token',
        'created_at',
        'updated_at',
        'pregunta_secreta_1', 
        'respuesta_secreta_1',
        'pregunta_secreta_2', 
        'respuesta_secreta_2',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Obtén la dirección de correo electrónico del usuario para el restablecimiento de la contraseña.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->correo; // Devuelve el campo 'correo' que se utiliza para el restablecimiento
    }
    


}
