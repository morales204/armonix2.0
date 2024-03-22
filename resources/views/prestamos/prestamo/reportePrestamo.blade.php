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
    <div>
    <img src="{{ public_path('img/Logo.png') }}" alt="" width="100px">
        
    </div>
    @foreach ($prestamos as $pres)
                        
    
    <table class="table">
        <tr>
            <td>Materia:</td>
            <td>{{$pres->materia}}</td>
        </tr>
        <tr>
            <td>Grado y grupo:</td>
            <td>{{$pres->grado_grupo}}</td>
        </tr>
        <tr>
            <td>Carrera:</td>
            <td>{{$pres->nombre_carrera}}</td>
        </tr>
        <tr>
            <td>Fecha:</td>
            <td>Del {{$pres->fecha_inicio}} al {{$pres->fecha_fin}}</td>
        </tr>
        <tr>
            <td>Horario:</td>
            <td>De {{$pres->hora_inicio}} a {{$pres->hora_fin}}</td>
        </tr>
        <tr>
            <td>Docente encargado:</td>
            <td>{{$pres->nombre_encargado}}</td>
        </tr>
        <tr>
            <td>Unidad tematica:</td>
            <td>{{$pres->unidad_tematica}}</td>
        </tr>
        <tr>
            <td>Laboratorio o taller:</td>
            <td>{{$pres->nombre_laboratorio}}</td>
        </tr>
        <tr>
            <td>No.Practica:</td>
            <td>{{$pres->no_practica}}</td>
        </tr>
        <tr>
            <td>Nombre de la practica:</td>
            <td>{{$pres->titulo_practica}}</td>
        </tr>
        <tr>
            <td>Fecha de la solicitud:</td>
            <td>{{$pres->fecha}} a las {{$pres->hora}}</td>
        </tr>
        <tr>
            <td>Nombre del solicitante:</td>
            <td>{{$pres->nombre_solicitante}}</td>
        </tr>
        <tr>
            <td>Duracion:</td>
            <td>{{$pres->duracion_horas}} hora</td>
        </tr>


        <tr>
            <td>Materiales y reactivos</td>
        </tr>

        <tr>
            <td>{{$pres->materiales}}</td>
        </tr>
    </table>
    

    @endforeach

</body>
</html>