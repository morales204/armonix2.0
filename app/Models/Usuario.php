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
        'correo',
        'username',
        'password',
        'roles_id_rol',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Get the e-mail address where password reset links are sent.
     */
    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }
}
