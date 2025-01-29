@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Servicio de publicidad</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Servicio de publicidad</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Publicidad Section -->
<div class="card text-center">
    <div class="card-header">
        Solicitud de Venta de Guitarra electrica
    </div>
    <div class="card-body">
    <img src="{{ asset('img/fender.png') }}" alt="">
        <p class="card-text">Descripcion:Guitarra eléctrica Fender Stratocaster, ideal para principiantes y profesionales.</p>
        <p class="card-text">Precio $456456</p>
        <p class="card-text">Vendedor:Fidel Castro </p>
        <a href="#" class="btn btn-success">Aceptar</a>
        <a href="#" class="btn btn-danger">Cancelar</a>
    </div>
</div>
<!-- Publicidad Section End -->
@endsection