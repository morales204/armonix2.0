@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Agregar Usuario</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Agregar Usuario</li>
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

                </div>

                {{-- CONTENIDO DEL CARD --}}
                <div class="card-content mt-4">

                    {{-- DETALLES DEL CARD INICIAL --}}
                    <div class="row d-flex justify-content-center">
                        <!-- card 1 -->
                        <form class="col-8">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre Completo</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>  
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Teléfono</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>  
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Correo Electrónico</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Rol</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                                <input type="text" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Confirmar contraseña</label>
                                <input type="number" class="form-control" id="exampleInputPassword1">
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hoverable rows end -->
@endsection