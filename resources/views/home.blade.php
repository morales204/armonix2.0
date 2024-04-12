@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header">{{ __('Bienvenid@!!') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                     $hora = date('H');
                    // Definimos el saludo según la hora
                    if ($hora >= 5 && $hora < 12) {
                        $saludo = '¡Buenos días';
                    } elseif ($hora >= 12 && $hora < 19) {
                        $saludo = '¡Buenas tardes';
                    } else {
                        $saludo = '¡Buenas noches';
                    }
                    $rol = DB::table('roles')->where('id_rol', auth()->user()->roles_id_rol)->value('rol');
                    @endphp
                
                    <p>{{ $saludo }}, {{ auth()->user()->nombre_completo}}!</p>
                    <p>{{ __('Your role is') }}: {{$rol}}</p>
                    {{ __('Has iniciado sesion!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
