@extends('layouts.admin')

@section('content')

<div class="container">
    <h4 class="mb-4">Resultados de búsqueda para: <strong>"{{ $query }}"</strong></h4>

    @if($instruments->isEmpty() && $instrumentTypes->isEmpty() && $courses->isEmpty())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>No se encontraron resultados.</strong> Intenta con otra búsqueda.
        </div>
    @else
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $instrumentType->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/cursos/instrumentos') }}">Cursos</a></li>
                        <li class="breadcrumb-item active">{{ $instrumentType->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.co

        <!-- Instrumentos -->
        @if(!$instruments->isEmpty())
        <h3 class="mt-4">Instrumentos</h3>
        <div class="row">
            @foreach($instruments as $instrument)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('img/instruments.png') }}" class="card-img-top" alt="{{ $instrument->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $instrument->name }}</h5>
                        <p class="card-text">Tipo: {{ $instrument->instrumentType->name }}</p>
                        <a href="{{ route('instrument.courses', ['id' => $instrument->id]) }}" class="btn btn-primary">Ver Cursos</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Tipos de Instrumentos -->
        @if(!$instrumentTypes->isEmpty())
        <h3 class="mt-4">Tipos de Instrumento</h3>
        <div class="row">
            @foreach($instrumentTypes as $type)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('img/instrument-type.png') }}" class="card-img-top" alt="{{ $type->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $type->name }}</h5>
                        <a href="{{ route('instrumento.detalles', ['id' => $type->id]) }}" class="btn btn-secondary">Ver Instrumentos</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <!-- Cursos -->
        @if(!$courses->isEmpty())
        <h3 class="mt-4">Cursos</h3>
        <div class="row">
            @foreach($courses as $course)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('img/courses.png') }}" class="card-img-top" alt="{{ $course->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 80) }}</p>
                        <a href="#" class="btn btn-info">Ir al curso</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

    @endif
</div>

@endsection
