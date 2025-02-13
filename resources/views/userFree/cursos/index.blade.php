@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mis cursos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Mis cursos</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Hoverable rows start -->
    <section class="section">
        <div class="row" id="table-hover-row">
            <div class="col-12">
                <div class="card">

                    {{-- CABEZERA DEL CARD --}}
                    <div class="card-header">
                            <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                                <option value="nombre">Nombre</option>
                                <option value="instrumento">Instrumento</option>
                                <option value="descripcion">Descripcion</option>
                            </select>

                            <input type="text" name="buscar" id="buscar">
                            <button class="btn btn-outline-success" onclick="search()" id="buscar">Buscar</button>

                    </div>

                    {{-- CONTENIDO DEL CARD --}}
                    <div class="card-content mt-4">
                        
                            {{-- DETALLES DEL CARD INICIAL --}}
                            <div class="row d-flex justify-content-center" id="cursos-container">
                                <!-- card 1 -->
                                 @foreach ($cursos as $cursosInstrumentos)
                                <div class="col-xl-10 col-md-12 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        {{$cursosInstrumentos->nombre}}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{$cursosInstrumentos->descripcion}}</div>
                                                        <span class="badge badge-success">{{$cursosInstrumentos->instrumento}}</span>
                                        
                                                </div>
                                                <div class="col-auto">
                                                    <i class="text-gray-300">
                                                    <button class="button_slide slide_down" onclick="verDetalles({{ $cursosInstrumentos->id }})">
                                                        Ver más detalles
                                                    </button>

                                                    </i>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            {{ $cursos->links() }}
                    </div>
                

                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->

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
                <p><strong>Instrumento:</strong> <span id="modalInstrumento"></span></p>
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
            url: "{{route ('cursoslist.index')}}",
            method: 'GET',
            data: {buscar: buscar, tipo: tipo},
            dataType: 'json',
            success: function(res){
                let cursosContainer = $("#cursos-container");
                cursosContainer.html(""); // Limpiar resultados previos

                if(res.cursos.data.length > 0){
                    res.cursos.data.forEach(function(curso){
                        let cursoHtml = `
                        <div class="col-xl-10 col-md-12 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        ${curso.nombre}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                   ${curso.descripcion}</div>
                                                        <span class="badge badge-success">${curso.instrumento}</span>
                                        
                                                </div>
                                                <div class="col-auto">
                                                    <i class="text-gray-300">
                                                        <button class="button_slide slide_down" onclick="verDetalles(${curso.id })">
                                                        Ver más detalles
                                                    </button>
                                                    </i>
                                                </div>

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
    fetch(`/cursos/cursoslist/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalNombre').textContent = data.curso.nombre;
                document.getElementById('modalDescripcion').textContent = data.curso.descripcion;
                document.getElementById('modalInstrumento').textContent = data.curso.instrumento;


                $('#cursoModal').modal('show'); // Mostrar el modal
                
            } else {
                alert("No se encontraron detalles del curso.");
            }
        })
        .catch(error => console.error("Error al obtener detalles:", error));
}
</script>
@endpush