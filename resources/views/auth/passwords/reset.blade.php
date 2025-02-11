<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px; /* Bordes más redondeados */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); /* Sombra suave */
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #555;
            font-size: 14px;
            margin-bottom: 5px;
        }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px; /* Bordes redondeados para los campos */
            font-size: 14px;
            box-sizing: border-box;
            margin-top: 5px;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 5px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg,rgb(138, 138, 138) 0%,rgb(9, 9, 9) 100%);
            color: white;
            border: none;
            border-radius: 12px; 
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); 
        }

        button:hover {
            background-color: #555; 
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15); 
        }

        .text-center {
            text-align: center;
            margin-top: 10px;
        }

        .text-center a {
            color: #007BFF;
            text-decoration: none;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Formulario de restablecimiento de contraseña -->
<div class="form-container">
    <h2>Restablecer Contraseña</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Correo electrónico -->
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autofocus>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nueva contraseña -->
        <div class="form-group">
            <label for="password">Nueva contraseña:</label>
            <input id="password" type="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirmar nueva contraseña -->
        <div class="form-group">
            <label for="password_confirmation">Confirmar nueva contraseña:</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Restablecer contraseña</button>
    </form>

    <div class="text-center">
        <p>¿Recuperaste tu contraseña? <a href="{{ route('login') }}">Iniciar sesión</a></p>
    </div>
</div>

</body>
</html>
