@extends('layouts.app')
@section('cssLogin')
    <!-- Importa la hoja de estilo de la sección -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleLogin.css') }}">
@endsection
@section('content')
<div class="container">
    <h2>Cambiar contraseña</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user_id }}"> <!-- Pasa el ID del usuario -->
        
        <div class="form-group">
            <label for="password">Nueva Contraseña</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Ingresa tu nueva contraseña" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirma tu nueva contraseña" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
    </form>


    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
@endsection
