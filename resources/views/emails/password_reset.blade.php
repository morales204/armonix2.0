<!-- resources/views/emails/password_reset.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecimiento de Contraseña</title>
</head>
<body>
    <h1>Restablecimiento de Contraseña</h1>

    <p>Hola,</p>
    <p>Recibiste este correo porque se solicitó un restablecimiento de contraseña para tu cuenta.</p>
    <p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>
ß
    <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}">
        Restablecer Contraseña
    </a>

    <p>Si no solicitaste este restablecimiento, ignora este correo.</p>

    <p>Gracias,</p>
    <p>El equipo de Armonix</p>
</body>
</html>
