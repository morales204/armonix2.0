@extends('layouts.admin')

@section('content')
<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Cursos Agregados</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Cursos agregados</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Cursos Section -->
<section class="section">
    <div class="container">
        <input type="text" id="busqueda" placeholder="Buscar curso" class="form-control mb-3">

        <div class="table-responsive">
            <table class="table table-striped table-bordered" id="tabla-cursos">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de fin</th>
                        <th>Instrumento</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                    <tr id="fila-{{ $curso->id }}">
                        <td>{{ $curso->id }}</td>
                        <td class="nombre">{{ $curso->name }}</td>
                        <td class="descripcion">{{ $curso->description }}</td>
                        <td>{{ $curso->created_at }}</td>
                        <td>{{ $curso->updated_at }}</td>
                        <td class="instrumento">{{ optional($curso->instrument)->name ?? 'No asignado' }}</td>
                        <td>
                            @if ($curso->image)
                            <img src="{{ asset($curso->image) }}" width="50" height="50" class="img-thumbnail">
                            @else
                            No disponible
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-warning btn-sm">Editar</a>

                            <!-- Botón de eliminación con AJAX -->
                            <button class="btn btn-danger btn-sm eliminar-curso" data-id="{{ $curso->id }}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $cursos->links() }}
        </div>
    </div>
</section>

<!-- Scripts -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Filtrado de cursos
        document.getElementById("busqueda").addEventListener("keyup", function() {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll("#tabla-cursos tbody tr");

            filas.forEach(fila => {
                let nombre = fila.querySelector(".nombre").innerText.toLowerCase();
                let descripcion = fila.querySelector(".descripcion").innerText.toLowerCase();
                let instrumento = fila.querySelector(".instrumento").innerText.toLowerCase();

                fila.style.display = (nombre.includes(filtro) || descripcion.includes(filtro) || instrumento.includes(filtro)) ? "" : "none";
            });
        });

        // Eliminar curso con AJAX
        document.querySelectorAll(".eliminar-curso").forEach(button => {
            button.addEventListener("click", function() {
                let cursoId = this.getAttribute("data-id");

                if (confirm("¿Estás seguro de que quieres eliminar este curso?")) {
                    fetch(`/cursos/${cursoId}`, {
                        method: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Content-Type": "application/json"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`fila-${cursoId}`).remove();
                            alert("Curso eliminado correctamente.");
                        } else {
                            alert("Error al eliminar el curso.");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Error al eliminar el curso.");
                    });
                }
            });
        });
    });
</script>
@endsection
