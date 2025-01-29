@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Metrónomo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Metrónomo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Metrónomo -->
    <div class="container mt-5">


        <!-- Funcionalidad del metrónomo -->
        <div class="container">
            
            <button id="startStopBtn" class="btn btn-primary">Iniciar</button>

            <div class="tempo-control">
                <label for="tempoRange">Tempo (BPM): </label>
                <input type="range" id="tempoRange" min="40" max="200" value="120">
                <span id="tempoValue">120 BPM</span>
            </div>
        </div>

        <!-- Sección de funciones de pago -->
        <div class="card mb-4 mt-5 shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h4>🎶 ⭐ Tu Experiencia Premium ⭐ 🎶</h4>
                <!-- <p>Disfruta de todas las funciones exclusivas</p> -->
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <h6 class="mt-2">🎨 Personalización Total</h6>
                    <p>Elige tus propios colores y estilos.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="mt-2">☁️ Sincronización Segura</h6>
                    <p>Tu configuración siempre disponible.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="mt-2">📞 Atención VIP</h6>
                    <p>Soporte prioritario 24/7.</p>
                </div>
            </div>
        </div>



<style>
    .card {
        border-radius: 15px; /* Bordes redondeados */
        overflow: hidden;
        align-self: center;
    }

    .card-header {
        font-weight: bold;
        border-radius: 15px 15px 0 0;
        align-items: center;
    }

    .card-body h5 {
        color: #295255; /* Color destacado */
        font-weight: bold;
    }

    .img-fluid {
        transition: transform 0.3s;
    }

    .img-fluid:hover {
        transform: scale(1.1);
    }
</style>

@endsection
