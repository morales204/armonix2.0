@extends('layouts.admin')

@section('template_title')
    Ver Nota Premium
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Notas</h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Herramientas</a></li>
                        <li class="breadcrumb-item active"><a href="/notas-premium">Notas</a></li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('notas-premium.show', $notasPremium->id_notaP) }}">
                                Ver más
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('') }} Nota Premium</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('notas-premium.index') }}"> {{ __('Atrás') }}</a>
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
