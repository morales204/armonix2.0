@extends('layouts.app')

@section('content')
    <h1>Resultados de la Búsqueda</h1>

    @if(empty($query))
        <p>Por favor, ingresa un término de búsqueda.</p>
    @else
        <p>Resultados para '{{ $query }}':</p>

        @if($instrumentTypes->isEmpty() && $instruments->isEmpty() && $courses->isEmpty())
            <p>No se encontraron resultados.</p>
        @else
            <h3>Instrument Types</h3>
            <ul>
                @foreach($instrumentTypes as $instrumentType)
                    <li>{{ $instrumentType->name }}</li>
                @endforeach
            </ul>

            <h3>Instruments</h3>
            <ul>
                @foreach($instruments as $instrument)
                    <li>{{ $instrument->name }} - {{ $instrument->description }}</li>
                @endforeach
            </ul>

            <h3>Courses</h3>
            <ul>
                @foreach($courses as $course)
                    <li>{{ $course->title }} - {{ $course->description }}</li>
                @endforeach
            </ul>
        @endif
    @endif
@endsection
