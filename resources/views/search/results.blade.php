@extends('layouts.app')

@section('content')
    <div class="container">
    <h2>Resultados de búsqueda para: "{{ $query }}"</h2>

@if($instruments->isEmpty() && $courses->isEmpty())
    <p>No se encontraron resultados.</p>
@else
    <h3>Instrumentos</h3>
    <ul>
        @foreach($instruments as $instrument)
            <li>{{ $instrument->name }}</li>
        @endforeach
    </ul>

    @if(!$courses->isEmpty())
        <h3>Cursos Relacionados</h3>
        <ul>
            @foreach($courses as $course)
                <li>{{ $course->name }} - {{ $course->description }}</li>
            @endforeach
        </ul>
    @endif
@endif

    </div>
@endsection