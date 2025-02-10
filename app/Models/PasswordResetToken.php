<?php

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';

    public function getEmailForPasswordReset()
    {
        return $this->correo;
    }
}

