@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Recuperar contraseña</h2>

    <!-- Recuperar contraseña Formulario -->
    <form method="POST" action="{{ route('password.sendRecoveryCode') }}">
        @csrf
        <div class="form-group">
            <label for="phone">Número de teléfono</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Ingresa tu número de teléfono">
        </div>

        <button type="submit" class="btn btn-primary">Enviar código</button>
    </form>

    <!-- Mostrar mensajes de error o éxito -->
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Mostrar errores de validación -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
