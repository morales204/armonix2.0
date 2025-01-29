@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cursos disponibles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Cursos disponibles</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Cursos Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                @php
                    $cursos = [
                        ['nombre' => 'Curso de Guitarra', 'tipo' => 'Gratis', 'fecha_inicio' => '15/02/25', 'fecha_fin' => '18/02/25', 'horario' => '7:20 a 8:00'],
                        ['nombre' => 'Curso de Piano', 'tipo' => 'De Paga', 'fecha_inicio' => '20/02/25', 'fecha_fin' => '25/02/25', 'horario' => '8:30 a 9:30'],
                        ['nombre' => 'Curso de Canto', 'tipo' => 'De Paga', 'fecha_inicio' => '25/03/25', 'fecha_fin' => '30/03/25', 'horario' => '9:00 a 10:00']
                    ];
                @endphp

                @foreach ($cursos as $curso)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="font-weight-bold">{{ $curso['nombre'] }}</h5>
                                    <span class="badge {{ $curso['tipo'] === 'Gratis' ? 'badge-success' : 'badge-warning' }}">
                                        {{ $curso['tipo'] }}
                                    </span>
                                </div>
                                <hr>
                                <p class="text-muted mb-1">Fecha: {{ $curso['fecha_inicio'] }} - {{ $curso['fecha_fin'] }}</p>
                                <p class="text-muted">Horario: {{ $curso['horario'] }}</p>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-sm">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Cursos Section End -->
@endsection
