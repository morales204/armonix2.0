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
                    <div class="card-header">{{ __('Pregunta Secreta') }}</div>

                    
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif


                        <form action="{{ route('actualizar.password') }}" method="POST">
                            @csrf
                            <input type="hidden" name="correo" value="{{ $correo }}">

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end mt-4">Contraseña</label>
                                <div class="col-md-6">
                                    <input type="password" name="password" required  class="form-control mt-4">
                                </div>
                            </div>

                            
                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-end mt-4">Confirmar contraseña:</label>
                                <div class="col-md-6">
                                    <input type="password" name="password_confirmation" required  class="form-control mt-4">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Restablecer') }}
                                    </button>
                                </div>
                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
        


@endsection