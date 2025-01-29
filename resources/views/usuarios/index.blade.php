@extends('layouts.admin')

@section('content')
    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Usuarios</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="col-xl-12">
                    <form action="{{ route('usuario.index') }}" method="get">

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group mb-6">
                                    {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span> --}}

                                    <input type="text" class="form-control" name="texto"
                                        placeholder="Ingresa el nombre del usuario" value="{{ $texto }}"
                                        aria-label="Recipient's username" aria-describedby="button-addon2">

                                    <button class="btn btn-outline-secondary" type="submit"
                                        id="button-addon2">Buscar</button>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group mb-6">
                                    {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-plus-circle-fill"></i></span> --}}

                                    <a href="{{ route('usuario.create') }}" class="btn btn-success">Nuevo</a>
                                </div>
                            </div>

                        </div>

                    </form>

                </div>
            </div>

            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>
                                Nombre Completo
                            </th>
                            <th>
                                Telefono
                            </th>
                            <th>
                                Correo
                            </th>
                            <th>
                                Nombre de usuario
                            </th>
                            <th>
                                Rol
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                            <td>
                                <p>
                                    {{$usuario->nombre_completo}}
                                </p>
                                {{--                                     <br />
                                    <small>
                                        Created 01.01.2019
                                    </small> --}}
                            </td>
                            <td>
                                <p>
                                    {{$usuario->telefono}}
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{$usuario->correo}}
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{$usuario->username}}
                                </p>
                            </td>
                            <td>
                                <p>
                                    {{$usuario->rol}}
                                </p>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm" href="{{ route('usuario.edit',$usuario->id_usuario)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm"><i
                                    class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                        @include('usuarios.modal')
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $usuarios->links() }}
            <!-- /.card-body -->
        </div>
        
        <input type="hidden" name="success_message" value="{{ session('success')}}">
        <script>
            var success = $("input[name='success_message']").val();
/*             var error = $("input[name='error_message']").val(); */
            if (success) {
                Swal.fire(success, "", "success");
            }
            if (error) {
                Swal.fire(error, "", "error");
            }
        </script>
        <!-- /.card -->

    </section>
@endsection
