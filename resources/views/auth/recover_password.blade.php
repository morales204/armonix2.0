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

                        <form action="/verificar-correo" method="POST">
                            @csrf
                            <div class="row mb-3">
                                <label for="correo" class="col-md-4 col-form-label text-md-end mt-4">Correo electrónico:</label>
                                <div class="col-md-6">
                                    <input type="email" name="correo" required  class="form-control mt-4">
                                </div>
                            </div>
                        
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Siguiente') }}
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