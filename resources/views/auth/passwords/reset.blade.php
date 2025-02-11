<!-- Formulario de reseteo de contraseña -->
<form method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">

    <!-- Correo electrónico -->
    <div>
        <label for="email">Correo electrónico:</label>
        <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required autofocus>
        @error('email')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <!-- Nueva contraseña -->
    <div>
        <label for="password">Nueva contraseña:</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <!-- Confirmar nueva contraseña -->
    <div>
        <label for="password_confirmation">Confirmar nueva contraseña:</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>
        @error('password_confirmation')
            <span class="text-red-500">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit">Restablecer contraseña</button>
</form>
