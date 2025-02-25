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
                <div class="card-header">Verificar código de recuperación</div>

                <div class="card-body">
                    <!-- Verificar código de recuperación Formulario -->
                    <form method="POST" action="{{ route('password.verify_code') }}">
                        @csrf
                        <div class="form-group">
                            <label for="recovery_code">Código de recuperación</label>
                            <input type="text" class="form-control" name="recovery_code" id="recovery_code" placeholder="Ingresa el código de recuperación">
                        </div>

                        <div class="d-flex justify-content-start">
                            <!-- Botón para verificar el código con un tamaño pequeño y margen a la derecha -->
                            <button type="submit" class="btn btn-primary btn-sm me-2">Verificar código</button>
                            
                            <!-- Opción para regresar con un tamaño pequeño -->
                            <a href="{{ route('password.recover-password') }}" class="btn btn-secondary btn-sm">Regresar</a>
                        </div>
                    </form>

                    @if(session('message'))
                        <div class="alert alert-info">{{ session('message') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
