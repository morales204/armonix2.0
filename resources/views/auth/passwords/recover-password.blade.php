@extends('layouts.app')

@section('cssLogin')
    <!-- Importa la hoja de estilo de la sección -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleLogin.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Recuperar Constraseña</div>

                        <div class="card-body">
                            <!-- Recuperar contraseña Formulario -->
                            <form method="POST" action="{{ route('password.sendRecoveryCode') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="phone">Número de teléfono</label>
                                    <input type="text" class="form-control" name="phone" id="phone" placeholder="Ingresa tu número de teléfono">
                                </div>

                                <div class="d-flex justify-content-start">
                                    <!-- Botón para enviar el código con un tamaño pequeño y margen a la derecha -->
                                    <button type="submit" class="btn btn-primary btn-sm me-2">Enviar código</button>
                                    
                                    <!-- Opción para los usuarios que ya tienen el código con un tamaño pequeño -->
                                    <a href="{{ route('password.show_validate_code_form') }}" class="btn btn-secondary btn-sm">Ya tengo un código</a>
                                </div>
                            </form>
    
                        </div>
                </div>
            </div>
    </div>

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
