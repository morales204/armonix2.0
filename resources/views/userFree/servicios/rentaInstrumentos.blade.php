@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Renta de Instrumentos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Renta de Instrumentos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Instrumentos Section -->
    <section class="section">
        <div class="container">
            <div class="row">
                @php
                    $instrumentos = [
                        ['nombre' => 'Guitarra Eléctrica', 'tipo' => 'Disponible', 'precio' => '$200', 'fecha_inicio' => '15/02/25', 'fecha_fin' => '18/02/25', 'horario' => '7:20 a 8:00'],
                        ['nombre' => 'Piano Digital', 'tipo' => 'No Disponible', 'precio' => '$300', 'fecha_inicio' => '20/02/25', 'fecha_fin' => '25/02/25', 'horario' => '8:30 a 9:30'],
                        ['nombre' => 'Violín', 'tipo' => 'Disponible', 'precio' => '$150', 'fecha_inicio' => '01/03/25', 'fecha_fin' => '05/03/25', 'horario' => '10:00 a 11:00'],
                        ['nombre' => 'Batería Acústica', 'tipo' => 'No Disponible', 'precio' => '$350', 'fecha_inicio' => '10/03/25', 'fecha_fin' => '15/03/25', 'horario' => '6:00 a 7:00'],
                        ['nombre' => 'Flauta', 'tipo' => 'Disponible', 'precio' => '$100', 'fecha_inicio' => '18/03/25', 'fecha_fin' => '20/03/25', 'horario' => '5:00 a 6:00'],
                        ['nombre' => 'Micrófono', 'tipo' => 'Disponible', 'precio' => '$80', 'fecha_inicio' => '25/03/25', 'fecha_fin' => '30/03/25', 'horario' => '9:00 a 10:00']
                    ];
                @endphp

                @foreach ($instrumentos as $instrumento)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="font-weight-bold">{{ $instrumento['nombre'] }}</h5>
                                    <span class="badge {{ $instrumento['tipo'] === 'Disponible' ? 'badge-success' : 'badge-danger' }}">
                                        {{ $instrumento['tipo'] }}
                                    </span>
                                </div>
                                <hr>
                                <p class="text-muted mb-1">Precio de renta: {{ $instrumento['precio'] }}</p>
                                <p class="text-muted">Fecha de disponibilidad: {{ $instrumento['fecha_inicio'] }} - {{ $instrumento['fecha_fin'] }}</p>
                                <p class="text-muted">Horario de renta: {{ $instrumento['horario'] }}</p>
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
    <!-- Instrumentos Section End -->
@endsection
