@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mis cursos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Mis cursos</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Cursos Section -->
    <section class="section">
        <div class="container">
            <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                <option value="nombre">Nombre</option>
                <option value="fecha_inicio">Fecha inicio</option>
                <option value="descripcion">Descripcion</option>
            </select>

            <input type="text" name="buscar" id="buscar">
            <button class="btn btn-outline-success" onclick="search()" id="buscar">Buscar</button>

            <div class="row" id="cursos-container">
                @foreach ($cursos as $curso)
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="font-weight-bold">{{$curso->nombre}}</h5>
                                    <span class="badge">
                                    {{$curso->descripcion}}
                                    </span>
                                </div>
                                <hr>
                                <p class="text-muted mb-1">Fecha: {{$curso->fecha_inicio}}</p>
                                <p class="text-muted">Horario: {{$curso->fecha_fin}}</p>
                                <div class="text-center">
                                <button class="button_slide slide_down" onclick="verDetalles({{ $curso->id_curso }})">
                                                        Ver más detalles
                                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$cursos->links()}}
        </div>
    </section>
    <!-- Cursos Section End -->
         <!-- Modal para detalles del curso -->
<div class="modal fade" id="cursoModal" tabindex="-1" aria-labelledby="cursoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cursoModalLabel">Detalles del Curso</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
                <p><strong>Descripción:</strong> <span id="modalDescripcion"></span></p>
                <p><strong>Duración:</strong> <span id="modalDuracion"></span></p>
                <p><strong>Fecha Inicio:</strong> <span id="modalFechaInicio"></span></p>
                <p><strong>Fecha Fin:</strong> <span id="modalFechaFin"></span></p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
        document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("buscar").addEventListener("keypress", function (event) {
            if (event.key === "Enter") {
                search();
            }
        });
    });


    function search (){
        let buscar = $("#buscar").val();
        let tipo = $("#tipo").val();

        $.ajax({
            url: "{{route ('miscursos.index')}}",
            method: 'GET',
            data: {buscar: buscar, tipo: tipo},
            dataType: 'json',
            success: function(res){
                let cursosContainer = $("#cursos-container");
                cursosContainer.html(""); 

                if(res.cursos.data.length > 0){
                    res.cursos.data.forEach(function(curso){
                        let cursoHtml = `
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <div class="card shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5 class="font-weight-bold">${curso.nombre}</h5>
                                            <span class="badge">${curso.descripcion}</span>
                                        </div>
                                        <hr>
                                        <p class="text-muted mb-1">Fecha: ${curso.nombre}</p>
                                        <p class="text-muted">Horario: ${curso.fecha_fin}</p>
                                        <div class="text-center">
                                            <button class="button_slide slide_down" onclick="verDetalles( ${curso.id_curso })">
                                                        Ver más detalles
                                                    </button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        cursosContainer.append(cursoHtml);
                    });
                } else {
                    cursosContainer.html("<p class='text-center'>No se encontraron cursos.</p>");
                }
            }
        });
    }

    function verDetalles(id) {
    fetch(`/cursos/miscursos/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalNombre').textContent = data.curso.nombre;
                document.getElementById('modalDescripcion').textContent = data.curso.descripcion;
                document.getElementById('modalDuracion').textContent = data.curso.duracion;
                document.getElementById('modalFechaInicio').textContent = data.curso.fecha_inicio;
                document.getElementById('modalFechaFin').textContent = data.curso.fecha_fin;



                $('#cursoModal').modal('show');
                
            } else {
                alert("No se encontraron detalles del curso.");
            }
        })
        .catch(error => console.error("Error al obtener detalles:", error));
}
</script>
@endpush
