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
            @foreach ($courses->take(3) as $curso) <!-- Carga inicial de 3 cursos -->
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
            <p>Cargando más cursos...</p>
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
    let offset = 3; // Comienza después de los 3 primeros cursos
    let cargando = false; // Para evitar múltiples solicitudes simultáneas

    function cargarMasCursos() {
        if (cargando) return;
        cargando = true;
        document.getElementById("cargando").style.display = "block";

        fetch(`/cargar-mas-cursos?offset=${offset}`) // Cambiar la URL según tu lógica
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const contenedor = document.getElementById("contenedorCursos");

                    data.forEach(curso => {
                        const card = document.createElement('div');
                        card.classList.add('col-12', 'col-sm-6', 'col-md-4', 'col-lg-3', 'mb-4');
                        card.innerHTML = `
                            <div class="card">
                                <a href="/course/contents/${curso.id}" class="stretched-link"></a>
                                <img src="${curso.image || 'img/default.png'}" class="card-img-top" alt="${curso.name}">
                                <div class="card-body">
                                    <h5 class="card-title">${curso.name}</h5>
                                    <p class="card-text">${curso.description.slice(0, 50)}</p>
                                    <a href="/course/contents/${curso.id}" class="btn btn-primary">Ir al Curso</a>
                                </div>
                            </div>
                        `;
                        contenedor.appendChild(card);
                    });

                    offset += 3; // Aumenta el offset para la siguiente carga
                } else {
                    window.removeEventListener('scroll', handleScroll); // Si no hay más cursos, desactiva el evento
                }
                cargando = false;
                document.getElementById("cargando").style.display = "none";
            })
            .catch(error => console.error('Error al cargar más cursos:', error));
    }

    function handleScroll() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 200) {
            cargarMasCursos();
        }
    }

    window.addEventListener('scroll', handleScroll);
});
</script>
@endsection