<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPasswordBase
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the reset password notification mail.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recuperación de contraseña')
            ->line('Has recibido este correo porque solicitaste restablecer tu contraseña.')
            ->action('Restablecer Contraseña', url(config('app.url') . route('password.reset', ['token' => $this->token, 'email' => $notifiable->correo], false)))
            ->line('Si no solicitaste un restablecimiento de contraseña, ignora este mensaje.');
    }
}
