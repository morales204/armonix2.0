@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Historial de prestamos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Historial de Prestamos</li>
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
                        <div class="col-xl-12">
                            <form action="{{ route('prestamo.historial') }}" method="get">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span> --}}

                                            <input type="text" class="form-control" name="texto"
                                                placeholder="Buscar prestamo" value="{{ $texto }}"
                                                aria-label="Recipient's username" aria-describedby="button-addon2">


                                            <div style="position: relative;">
                                                @if (!isset($_GET['texto']))
                                                    <div id="toggleDateFilter" class="btn btn-outline-secondary">Filtrar por
                                                        fecha</div>
                                                    <button class="btn btn-outline-secondary" type="submit"
                                                        id="button-addon2">Buscar</button>
                                                @endif
                                                <div id="dateFilter" class="date-filter" style="display: none;">
                                                    <label for="periodoInicio">Fecha de inicio:</label>
                                                    <input type="date" id="periodoInicio" name="periodoInicio"
                                                        class="form-control" value="{{ $periodoInicio ?? '' }}">
                                                    <label for="periodoFin">Fecha de fin:</label>
                                                    <input type="date" id="periodoFin" name="periodoFin"
                                                        class="form-control" value="{{ $periodoFin ?? '' }}">
                                                </div>
                                            </div>

                                            <style>
                                                .date-filter {
                                                    position: absolute;
                                                    top: 40px;
                                                    left: 0;
                                                    background-color: #fff;
                                                    /* Fondo blanco */
                                                    border: 1px solid #ccc;
                                                    /* Borde gris */
                                                    padding: 10px;
                                                    border-radius: 5px;
                                                    /* Bordes redondeados */
                                                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                                                    /* Sombra suave */
                                                    z-index: 1000;
                                                    /* Para asegurar que esté encima de otros elementos */
                                                }
                                            </style>

                                            <script>
                                                var timeout;

                                                document.getElementById('toggleDateFilter').addEventListener('click', function() {
                                                    var dateFilter = document.getElementById('dateFilter');
                                                    if (dateFilter.style.display === 'none') {
                                                        dateFilter.style.display = 'block';

                                                        // Reiniciar el temporizador si el filtro se muestra nuevamente
                                                        clearTimeout(timeout);
                                                        timeout = setTimeout(function() {
                                                            dateFilter.style.display = 'none';
                                                        }, 5000); // Ocultar después de 5 segundos de inactividad
                                                    } else {
                                                        dateFilter.style.display = 'none';
                                                    }
                                                });

                                                // Ocultar el filtro después de un período de inactividad
                                                document.getElementById('dateFilter').addEventListener('mouseover', function() {
                                                    clearTimeout(timeout);
                                                });

                                                document.getElementById('dateFilter').addEventListener('mouseleave', function() {
                                                    timeout = setTimeout(function() {
                                                        document.getElementById('dateFilter').style.display = 'none';
                                                    }, 5000); // Ocultar después de 5 segundos de inactividad
                                                });

                                                // Ocultar el filtro cuando se hace clic fuera de él
                                                document.addEventListener('click', function(event) {
                                                    var dateFilter = document.getElementById('dateFilter');
                                                    var toggleDateFilter = document.getElementById('toggleDateFilter');
                                                    if (!dateFilter.contains(event.target) && event.target !== toggleDateFilter) {
                                                        dateFilter.style.display = 'none';
                                                    }
                                                });
                                            </script>


                                            @if (isset($_GET['texto']))
                                                <a href="{{ route('prestamo.historial') }}"
                                                    class="btn btn-outline-danger">Cancelar
                                                    búsqueda</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-plus-circle-fill"></i></span> --}}
                                            <a href="{{ route('prestamo.create') }}" class="btn btn-success">Nueva</a>
                                        @if ($prestamos->isEmpty())
                                            
                                        @else
                                            <a href="{{ route('prestamo.historial', ['pdf' => 1, 'texto' => $texto, 'periodoInicio' => $periodoInicio, 'periodoFin' => $periodoFin]) }}" class="btn btn-secondary ml-auto" id="generatePdfLink">Generar PDF</a>
                                        @endif

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>

                    {{-- CONTENIDO DEL CARD --}}
                    <div class="card-content mt-4">
                        @if ($prestamos->isEmpty())
                        <h1>No tienes prestamos pendientes</h1>
                        @endif
                        @foreach ($prestamos as $pres)
                            {{-- DETALLES DEL CARD INICIAL --}}
                            <div class="row d-flex justify-content-center">
                                <!-- card 1 -->
                                <div class="col-xl-10 col-md-12 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        {{ $pres->titulo_practica }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        {{ $pres->ubicacion }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Del
                                                        {{ $pres->fecha_inicio }} al {{ $pres->fecha_fin }}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">De
                                                        {{ $pres->hora_inicio }} a {{ $pres->hora_fin }}</div>


                                                    @if ($pres->descripcion == 'Aceptado')
                                                        <span class="badge badge-success">Aceptado</span>
                                                    @elseif ($pres->descripcion == 'Rechazado')
                                                        <span class="badge badge-danger">Rechazado</span>
                                                    @else
                                                        <span class="badge badge-warning">Pendiente</span>
                                                    @endif
                                                </div>
                                                <div class="col-auto">
                                                    <i class="text-gray-300">
                                                        <div id="btnDetalles_{{ $pres->id_prestamo }}"
                                                            class="button_slide slide_down">Ver mas
                                                            detalles</div>
                                                    </i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- DETALLES ADICIONALES --}}
                            <div id="detallesAdicionales_{{ $pres->id_prestamo }}" style="display: none;">
                                <p><strong>Fecha de la solicitud:</strong> {{ $pres->fecha }} a las {{ $pres->hora }}
                                </p>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="border p-2 mb-3">
                                            <p><strong>Fecha:</strong> Del {{ $pres->fecha_inicio }} al
                                                {{ $pres->fecha_fin }}</p>
                                            <p><strong>Horario:</strong> De {{ $pres->hora_inicio }} a
                                                {{ $pres->hora_fin }}</p>
                                            <p><strong>Duración:</strong> {{ $pres->duracion_horas }} hora(s)</p>
                                            <p><strong>Docente encargado:</strong> {{ $pres->nombre_encargado }}</p>
                                            <p><strong>Nombre del solicitante:</strong> {{ $pres->nombre_solicitante }}</p>
                                            <p><strong>Correo:</strong> {{ $pres->correo }}</p>
                                            <p><strong>Telefono:</strong> {{ $pres->telefono }}</p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="border p-2 mb-3">
                                            <p><strong>Materia:</strong> {{ $pres->materia }}</p>
                                            <p><strong>Grado y grupo:</strong> {{ $pres->grado_grupo }}</p>
                                            <p><strong>Carrera:</strong> {{ $pres->nombre_carrera }}</p>
                                            <p><strong>Unidad temática:</strong> {{ $pres->unidad_tematica }}</p>
                                            <p><strong>Título de la práctica:</strong> {{ $pres->titulo_practica }}</p>
                                            <p><strong>No. Práctica:</strong> {{ $pres->no_practica }}</p>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="border p-2 mb-3">
                                            <p><strong>Introduccion:</strong> {{ $pres->introduccion }}</p>
                                            <p><strong>Objetivo:</strong> {{ $pres->objetivo }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">

                                    @if ($pres->materiales && $pres->materiales->isNotEmpty())
                                        <h3>Materiales</h3>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">Nombre del Material</th>
                                                                    <th scope="col">Volumen</th>
                                                                    <th scope="col">Cantidad</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($pres->materiales as $mat)
                                                                    <tr>
                                                                        <td>{{ $mat->nombre_material }}</td>
                                                                        <td>{{ $mat->volumen }}</td>
                                                                        <td>{{ $mat->cantidad_material ?? '' }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($pres->reactivos && $pres->reactivos->isNotEmpty())
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h3 class="mb-4">Reactivos</h3>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">Nombre del Reactivo</th>
                                                                    <th scope="col">Cantidad</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($pres->reactivos as $reac)
                                                                    <tr>
                                                                        <td>{{ $reac->nombre_reactivo }}</td>
                                                                        <td>{{ $reac->cantidad_reactivo }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </div>

                            </div>


                            <script>
                                // funcion btn ver mas detalles
                                $("#btnDetalles_{{ $pres->id_prestamo }}").click(function() {
                                    const additionalInfo = $("#detallesAdicionales_{{ $pres->id_prestamo }}").html();

                                    Swal.fire({
                                        title: "Detalles",
                                        html: additionalInfo,
                                        width: 1000,
                                    })
                                });
                            </script>
                        @endforeach

                    </div>
                    {{ $prestamos->links() }}
                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->
@endsection
