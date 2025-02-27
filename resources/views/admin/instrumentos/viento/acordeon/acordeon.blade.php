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
                    <li class="breadcrumb-item"><a href="{{ route('instrumentos.index') }}">Cursos</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('instrument.acordeon') }}">{{ $instrumentType->name }}</a></li>
                    <li class="breadcrumb-item active">{{ $instrument->name }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Courses Section -->
        <div id="contenedorCursos" class="row">
            @foreach ($courses->take(4) as $curso) <!-- Carga inicial de 3 cursos -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card">
                    <a href="{{ route('course.contents', ['courseId' => $curso->id]) }}" class="stretched-link"></a> <!-- Enlace que cubre toda la tarjeta -->
                    <img src="{{ asset($curso->image ?? 'img/default.png') }}" class="card-img-top" alt="{{ $curso->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $curso->name }}</h5>
                        <p class="card-text">{{ Str::limit($curso->description, 50) }}</p>
                        <a href="{{ route('course.contents', ['courseId' => $curso->id]) }}" class="btn btn-primary">Ir al Curso</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div id="cargando" style="display: none; text-align: center; margin: 20px 0;">
            <p>Cargando más cursos...</p>
        </div>
    </div>
</section>

<style>
    .card {
        border: 1px solid #eee;
        margin-bottom: 20px;
        padding: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .card-title a {
        color: #333;
        text-decoration: none;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let offset = 4; // Asegurar que coincida con el backend
    let cargando = false;
    let hayMasCursos = true; // Nueva bandera para evitar peticiones innecesarias
    let instrumentId = "{{ $instrument->id }}"; // ID del instrumento actual

    function cargarMasCursos() {
        if (cargando || !hayMasCursos) return;
        cargando = true;
        document.getElementById("cargando").style.display = "block";

        fetch(`/cargar-mas-cursos?offset=${offset}&instrument_id=${instrumentId}`)
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data) && data.length > 0) {
                    const contenedor = document.getElementById("contenedorCursos");

                    data.forEach(curso => {
                        const card = document.createElement('div');
                        card.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-3', 'mb-4');
                        card.innerHTML = `
                            <div class="card">
                                <a href="/course/contents/${curso.id}" class="stretched-link" data-course-id="${curso.id}"></a>
                                <img src="${curso.image || 'img/default.png'}" class="card-img-top" alt="${curso.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${curso.name}</h5>
                                    <p class="card-text">${curso.description ? curso.description.slice(0, 50) : 'Sin descripción'}</p>
                                    <a href="/course/contents/${curso.id}" class="btn btn-primary">Ir al Curso</a>
                                </div>
                            </div>
                        `;
                        contenedor.appendChild(card);
                    });

                    offset += 4; // Actualizar el offset
                } else {
                    hayMasCursos = false; // Si ya no hay más cursos, desactivar carga
                    window.removeEventListener('scroll', handleScroll);
                }
            })
            .catch(error => {
                console.error('Error al cargar más cursos:', error);
            })
            .finally(() => {
                cargando = false;
                document.getElementById("cargando").style.display = "none";
            })
            .catch(error => {
                console.error('Error al cargar más cursos:', error);
                cargando = false;
                document.getElementById("cargando").style.display = "none";
            });
    }

    // Usando jQuery para manejar el clic
    document.addEventListener('click', function(e) {
        if (e.target && e.target.matches('.btn.btn-primary[data-course-id]')) {
            var courseId = e.target.getAttribute('data-course-id');
            // Redirigir a la vista de detalles con el courseId
            window.location.href = `/course/contents/${courseId}`;
        }
    });
    function debounce(func, wait = 200) {
        let timeout;
        return function () {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, arguments), wait);
        };
    }

    function handleScroll() {
        let scrollTop = window.scrollY || document.documentElement.scrollTop;
        let windowHeight = window.innerHeight;
        let documentHeight = document.documentElement.scrollHeight;

        if ((scrollTop + windowHeight) >= (documentHeight - 200)) {
            cargarMasCursos();
        }
    }

    window.addEventListener('scroll', debounce(handleScroll, 300)); // Evitar múltiples peticiones innecesarias
});
</script>



@endsection