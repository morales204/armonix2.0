@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Usuarios</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Usuarios</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Usuario</th>
            <th scope="col">Correo</th>
            <th scope="col">Contraseña</th>
            <th scope="col">Rol</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Bryan Hernández</td>
            <td>Bryan</td>
            <td>bry.hluna@gmail.com</td>
            <td>*********</td>
            <td>Admin</td>
            <td>
                <button type="button" class="btn btn-warning">Editar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
            </td>
        </tr>

        <tr>
            <th scope="row">2</th>
            <td>Jesús Luna</td>
            <td>Jesús</td>
            <td>jesluna@gmail.com</td>
            <td>*********</td>
            <td>Usuario</td>
            <td>
                <button type="button" class="btn btn-warning">Editar</button>
                <button type="button" class="btn btn-danger">Eliminar</button>
            </td>
        </tr>
    </tbody>
</table>

<!-- Hoverable rows end -->
@endsection