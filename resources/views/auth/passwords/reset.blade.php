<!-- Formulario de reseteo de contraseña -->
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    
    <div>
        <label for="email">Correo electrónico:</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div>
        <label for="password">Nueva contraseña:</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <label for="password_confirmation">Confirmar nueva contraseña:</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
    </div>

    <button type="submit">Restablecer contraseña</button>
</form>
