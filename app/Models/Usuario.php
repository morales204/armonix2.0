<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword as PasswordsCanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable implements CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable, PasswordsCanResetPassword;

    public $timestamps = false;
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre_completo',
        'telefono',
        'email',
        'username',
        'password',
        'roles_id_rol',
        'remember_token',
        'secret_answer',
        'secret_question',
        'secret_answer_2' ,
        'secret_question_2', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'secret_answer', 
        'secret_answer_2',
    ];

    protected $casts = [
        'password' => 'hashed', // Laravel 10+ lo usa para encriptar automáticamente
    ];

    /**
     * Devuelve el email del usuario para el restablecimiento de contraseña.
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

}
