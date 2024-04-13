<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ public_path('pdf.css') }}" type="text/css">

</head>

<body>
    @foreach ($prestamos as $pres)
        <div class="page">

            <table class="encabezado">
                <thead>
                    <th>
                        <div class="logoApp">
                            <img src="{{ public_path('img/logo2.png') }}" alt="">
                        </div>
                    </th>

                    <th>
                        <div class="titulo">
                            <h1>Universidad Tecnologica de la Selva</h1>
                            <h2>Laboratorio de Agronomia</h2>
                        </div>
                    </th>

                    <th>
                        <div class="logoUts">
                            <img src="{{ public_path('img/logouts2.png') }}" alt="">
                        </div>

                    </th>
                </thead>


            </table>

            <div class="content">
                <p>Nombre del solicitante: {{ $pres->nombre_solicitante }}</p>
                <p>Fecha de solicitud: {{ $pres->fecha }} a las  {{ $pres->hora }}</p>
                <p>Estado del prestamo: {{ $pres->descripcion }}</p>
                <p>No. Prestamo: {{ $pres->id_prestamo }}</p>
                
                <br>
                <table class="tableInfo">

                    <tr>
                        <td>Materia:</td>
                        <td>{{ $pres->materia }}</td>
                    </tr>

                    <tr>
                        <td>Grado y grupo:</td>
                        <td>{{ $pres->grado_grupo }}</td>
                    </tr>
                    <tr>
                        <td>Carrera:</td>
                        <td>{{ $pres->nombre_carrera }}</td>
                    </tr>

                    <tr>
                        <td>Fecha:</td>
                        <td>Del {{ $pres->fecha_inicio }} al {{ $pres->fecha_fin }}</td>
                    </tr>
                    <tr>
                        <td>Horario:</td>
                        <td>De {{ $pres->hora_inicio }} a {{ $pres->hora_fin }}</td>
                    </tr>

                    <tr>
                        <td>Docente encargado:</td>
                        <td>{{ $pres->nombre_encargado }}</td>
                    </tr>

                    <tr>
                        <td>Unidad tematica:</td>
                        <td>{{ $pres->unidad_tematica }}</td>
                    </tr>
                    <tr>
                        <td>Laboratorio o taller:</td>
                        <td>{{ $pres->nombre_laboratorio }}</td>
                    </tr>
                    <tr>
                        <td>No.Practica:</td>
                        <td>{{ $pres->no_practica }}</td>
                    </tr>
                    <tr>
                        <td>Titulo de la practica:</td>
                        <td>{{ $pres->titulo_practica }}</td>
                    </tr>

                    <tr>
                        <td>Duracion:</td>
                        <td>{{ $pres->duracion_horas }} hora</td>
                    </tr>
                </table>

                    <p>Introduccion: {{ $pres->introduccion }}</p>
    
                    <p>Obejtivo: {{ $pres->objetivo }}</p>

                @if ($pres->materiales && $pres->materiales->isNotEmpty())
                    <h3>Materiales</h3>

                    <table>
                        <thead>
                            <th>Nombre del material</th>
                            <th>Volumen</th>
                            <th>Cantidad</th>
                        </thead>
                        <tbody>
                            @foreach ($pres->materiales as $material)
                                <tr>
                                    <td>{{ $material->nombre_material }}</td>
                                    <td>{{ $material->volumen }}</td>
                                    <td>{{ $material->cantidad_material ?? '' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                @if ($pres->reactivos && $pres->reactivos->isNotEmpty())
                    <h3>Reactivos</h3>

                    <table>
                        <thead>
                            <th>Nombre del reactivo</th>
                            <th>Cantidad</th>
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
                @endif

            </div>
        </div>
        @if (!$loop->last)
            <!-- Agrega un salto de página después de cada elemento, excepto el último -->
            <div style="page-break-after: always;"></div>
        @endif
    @endforeach
</body>

</html>
