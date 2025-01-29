@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Notas</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Notas</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Notas -->        
        <div class="card mb-4 mt-5">
    <div class="card-header">
        <span class="float-right text-black">
            <img class="wave" src="{{ asset('img/lista-de-rep.png') }}" style="width: 35px; margin-right:5px;">
            Agregar Nota
        </span>
    </div>
    <div class="card-body">
        <div class="row">
            
                <div class="col-md-4">
                    <div class="nota-card">
                        <div class="nota-contenido">
                            <p class="nota-texto">Mi primera Nota</p>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>
</div>

<style>
    .nota-card {
        background: #F0F5F7; /* Color de fondo */
        border-radius: 15px; /* Bordes redondeados */
        padding: 15px;
        text-align: center;
        transition: 0.3s;
        position: relative;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        min-height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nota-texto {
        font-size: 16px;
        color: #162623;
        font-weight: bold;
    }

    /* Imagen predeterminada */
    .nota-card::before {
        content: "";
        background: url("{{ asset('img/musica.png') }}") no-repeat center;
        background-size: 40px;
        width: 40px;
        height: 40px;
        position: absolute;
        top: -10px;
        right: -10px;
        transition: 0.3s;
    }

    /* Cambia la imagen al pasar el mouse */
    .nota-card:hover::before {
        background: url("{{ asset('img/notas.png') }}") no-repeat center;
        background-size: 40px;
    }

    .nota-card:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
</style>


@endsection
