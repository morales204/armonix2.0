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
                        @if(isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @endif

                        <form action="/validar-respuesta" method="POST">
                            @csrf
                            <input type="hidden" name="correo" value="{{ $usuario->correo }}">

                            <div class="row mb-3">
                                <label for="correo" class="col-md-4 col-form-label text-md-end mt-4">{{ $usuario->pregunta_secreta_1 }}</label>
                                <div class="col-md-6">
                                   <input type="text" name="respuesta_secreta_1" required  class="form-control mt-4">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="correo" class="col-md-4 col-form-label text-md-end mt-4">{{ $usuario->pregunta_secreta_2 }}</label>
                                <div class="col-md-6">
                                   <input type="text" name="respuesta_secreta_2" required  class="form-control mt-4">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Verificar Respuesta') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
        


@endsection