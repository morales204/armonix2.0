@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>Resultados de búsqueda para: "{{ $query }}"</h2>

    @if($instruments->isEmpty() && $courses->isEmpty() && $instrumentTypes->isEmpty())
        <p>No se encontraron resultados.</p>
    @else
        {{-- Mostrar Instrumentos --}}
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

        {{-- Mostrar Cursos --}}
        @if(!$courses->isEmpty())
            <h3 class="mt-4">Cursos</h3>
            <div class="row">
                @foreach($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>{{ $course->name }}</strong></h5>
                                <p class="card-text">{{ Str::limit($course->description, 80) }}</p>
                                <button class="btn btn-info course-link" data-url="{{ route('course.contents', ['courseId' => $course->id]) }}">Ir al curso</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Mostrar Tipos de Instrumento --}}
        @if(!$instrumentTypes->isEmpty())
            <h3 class="mt-4">Tipos de Instrumentos</h3>
            <ul>
                @foreach($instrumentTypes as $type)
                    <li>{{ $type->name }}</li>
                @endforeach
            </ul>
        @endif
    @endif
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".course-content").forEach(function(button) {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            let url = this.getAttribute("data-url");
            console.log("Clic en botón, URL:", url); // Depuración

            fetch(url, { method: "GET" })
                .then(response => {
                    console.log("Respuesta recibida", response); // Depuración
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(data => {
                    console.log("Datos recibidos", data); // Depuración
                    window.location.href = url;
                })
                .catch(error => console.error("Error al cargar el curso:", error));
        });
    });
});

</script>

@endsection
