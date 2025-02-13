@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Resultados de búsqueda para: "{{ $query }}"</h2>

        @if($instruments->isEmpty() && $instrumentTypes->isEmpty() && $courses->isEmpty() && $users->isEmpty())
            <p>No se encontraron resultados.</p>
        @else
            <h3>Instrumentos</h3>
            <ul>
                @foreach($instruments as $instrument)
                    <li>{{ $instrument->name }} (Tipo: {{ $instrument->instrumentType->name }})</li>
                @endforeach
            </ul>

            <h3>Tipos de Instrumento</h3>
            <ul>
                @foreach($instrumentTypes as $type)
                    <li>{{ $type->name }}</li>
                @endforeach
            </ul>

            <h3>Cursos</h3>
            <ul>
                @foreach($courses as $course)
                    <li>{{ $course->title }} - {{ $course->description }}</li>
                @endforeach
            </ul>

        @endif
    </div>
@endsection
