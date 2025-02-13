@extends('layouts.admin')

@section('template_title')
    Ver Nota Premium
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Notas Premium</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('notas-premium.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <!-- Verifica si la nota existe -->
                        @if ($notasPremium)
                            <p><strong>Nombre de la nota:</strong> {{ $notasPremium->nombre_notaP }}</p>
                            <p><strong>Contenido de la nota:</strong> {{ $notasPremium->contenido_notaP }}</p>
                        @else
                            <p>No se encontró la nota.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
