@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>Resultados de búsqueda para: "{{ $query }}"</h2>

    @if($instruments->isEmpty() && $courses->isEmpty())
    <p>No se encontraron resultados.</p>
    @else

    @endif

    <!-- Instrumentos -->
    @if(!$instruments->isEmpty())
    <h3 class="mt-4">Instrumentos</h3>
    <div class="row">
        @foreach($instruments as $instrument)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('img/instruments.png') }}" class="card-img-top" alt="{{ $instrument->name }}">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ $instrument->name }}</strong></h5>
                    <p class="card-text">Tipo: {{ $instrument->instrumentType->name }}</p>
                    <a href="{{ route('instrument.courses', ['id' => $instrument->id]) }}" class="btn btn-primary">Ver Cursos</a>
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
            <img src="{{ asset($instrument->image) }}" class="card-img-top" alt="{{ $instrument->name }}">
                <div class="card-body">
                    <h5 class="card-title"><strong>{{ $course->name }}</strong></h5>
                    <p class="card-text">{{ Str::limit($course->description, 80) }}</p>
                    <a href="{{ route('course.contents', ['courseId' => $course->id]) }}" class="btn btn-info">
                        <i class="fas fa-chalkboard-teacher"></i> Ir al curso
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

@endsection