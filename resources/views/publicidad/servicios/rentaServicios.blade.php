@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Renta de Servicios Musicales</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Renta de Servicios Musicales</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Servicios Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                @php
                    $servicios = [
                        ['nombre' => 'Clases de Guitarra', 'tipo' => 'Disponible', 'precio' => '$500', 'fecha_inicio' => '15/02/25', 'fecha_fin' => '18/02/25', 'horario' => '7:20 a 8:00'],
                        ['nombre' => 'Clases de Piano', 'tipo' => 'No Disponible', 'precio' => '$600', 'fecha_inicio' => '20/02/25', 'fecha_fin' => '25/02/25', 'horario' => '8:30 a 9:30'],
                        ['nombre' => 'Estudio de Grabación', 'tipo' => 'Disponible', 'precio' => '$1000', 'fecha_inicio' => '01/03/25', 'fecha_fin' => '05/03/25', 'horario' => '10:00 a 11:00'],
                        ['nombre' => 'Arreglos Musicales', 'tipo' => 'No Disponible', 'precio' => '$1200', 'fecha_inicio' => '10/03/25', 'fecha_fin' => '15/03/25', 'horario' => '6:00 a 7:00'],
                        ['nombre' => 'DJ para Eventos', 'tipo' => 'Disponible', 'precio' => '$1500', 'fecha_inicio' => '18/03/25', 'fecha_fin' => '20/03/25', 'horario' => '5:00 a 6:00'],
                        ['nombre' => 'Banda para Eventos', 'tipo' => 'Disponible', 'precio' => '$3000', 'fecha_inicio' => '25/03/25', 'fecha_fin' => '30/03/25', 'horario' => '9:00 a 10:00']
                    ];
                @endphp

                @foreach ($servicios as $servicio)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="font-weight-bold">{{ $servicio['nombre'] }}</h5>
                                    <span class="badge {{ $servicio['tipo'] === 'Disponible' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $servicio['tipo'] }}
                                    </span>
                                </div>
                                <hr>
                                <p class="text-muted mb-1">Precio de renta: {{ $servicio['precio'] }}</p>
                                <p class="text-muted">Fecha de disponibilidad: {{ $servicio['fecha_inicio'] }} - {{ $servicio['fecha_fin'] }}</p>
                                <p class="text-muted">Horario de renta: {{ $servicio['horario'] }}</p>
                                <div class="text-center">
                                    <button class="btn btn-primary btn-sm">Ver detalles</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Servicios Section End -->
@endsection
