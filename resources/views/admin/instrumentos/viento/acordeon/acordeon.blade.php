@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $instrument->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/cursos/instrumentos') }}">Cursos</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('instrument.acordeon') }}">{{ $instrumentType->name }}</a></li>
                        <li class="breadcrumb-item active">{{ $instrument->name }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Courses Section -->
            <div class="row">
                @forelse ($courses as $curso)   
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card">
                            <img src="{{ asset($curso->image ?? 'img/default.png') }}" class="card-img-top" alt="{{ $curso->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $curso->name }}</h5>
                                <p class="card-text">{{ Str::limit($curso->description, 50) }}</p>
                                <a href="{{ route('instrument.courses', $curso->id) }}" class="btn btn-primary">Ir al Curso</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No hay cursos disponibles para este instrumento.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
