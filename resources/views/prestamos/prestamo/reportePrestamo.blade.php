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
            <div class="logo">
                <img src="{{ public_path('img/Logo.png') }}" alt="" width="100px;">
            </div>
            <div class="content">
                <table class="table">
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
                        <td>Nombre de la practica:</td>
                        <td>{{ $pres->titulo_practica }}</td>
                    </tr>
                    <tr>
                        <td>Fecha de la solicitud:</td>
                        <td>{{ $pres->fecha }} a las {{ $pres->hora }}</td>
                    </tr>
                    <tr>
                        <td>Nombre del solicitante:</td>
                        <td>{{ $pres->nombre_solicitante }}</td>
                    </tr>
                    <tr>
                        <td>Duracion:</td>
                        <td>{{ $pres->duracion_horas }} hora</td>
                    </tr>
                    <tr>
                        <td>Introduccion:</td>
                        <td>{{ $pres->introduccion }}</td>
                    </tr>
                    <tr>
                        <td>Obejtivo:</td>
                        <td>{{ $pres->objetivo }}</td>
                    </tr>
                </table>

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
<style>


body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .page {
            margin-bottom: 40px;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo img {
            width: 100px;
        }

        .content {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table th {
            background-color: #f2f2f2;
            text-align: left;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 20px;
            margin-top: 20px;
        }

        ul {
            margin-top: 10px;
            padding-left: 20px;
        }

        li {
            list-style-type: disc;
        }
</style>
</body>

</html>