@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cursos Agregados</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Cursos agregados</li>
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

                @foreach ($cursos as $curso)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="font-weight-bold">{{$curso->nombre}}</h5>
                                    <span class="badge">
                                    {{$curso->descripcion}}
                                    </span>
                                </div>
                                <hr>
                                <p class="text-muted mb-1">Fecha: {{$curso->fecha_inicio}}</p>
                                <p class="text-muted">Horario: {{$curso->fecha_fin}}</p>
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
@endsection
