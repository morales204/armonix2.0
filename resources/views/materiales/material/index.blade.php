@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Materiales</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Materiales</li>
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
                    <div class="card-header">
                        <div class="col-xl-12">
                            <form action="{{ route('material.index') }}" method="get">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span> --}}

                                            <input type="text" class="form-control" name="texto"
                                                placeholder="Buscar material" value="{{ $texto }}"
                                                aria-label="Recipient's username" aria-describedby="button-addon2">

                                            <button class="btn btn-outline-secondary" type="submit"
                                                id="button-addon2">Buscar</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-plus-circle-fill"></i></span> --}}

                                            <a href="{{ route('material.create') }}" class="btn btn-success">Nuevo</a>
                                        </div>
                                    </div>

                                </div>

                            </form>

                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                        </div>
                        <!-- table hover -->
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class='text-center'>Id</th>
                                        <th>Nombre</th>
                                        <th>Cantidad Disponible</th>
                                        <th>Descripcion</th>
                                        <th>Volumen</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($material as $mat)
                                        <tr>
                                            <td class='text-center'>{{ $mat->id_material }}</td>
                                            <td>{{ $mat->nombre_material }}</td>
                                            <td>{{ $mat->cantidad_disponible }}</td>
                                            <td>{{ $mat->descripcion }}</td>
                                            <td>{{ $mat->volumen }}</td>
                                            <td>
                                                <a href="{{ route('material.edit', $mat->id_material) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                                <!-- Button trigger for danger theme modal -->
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteMaterialConfirmation({{ $mat->id_material }})"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        @include('materiales.material.modal')
                                    @endforeach

                                </tbody>
                            </table>
                            {{ $material->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->
@endsection
