@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reactivos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Reactivos</li>
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
                            <form action="{{ route('reactivo.index') }}" method="get">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span> --}}

                                            <input type="text" class="form-control" name="texto"
                                                placeholder="Buscar reactivo" value="{{ $texto }}"
                                                aria-label="Recipient's username" aria-describedby="button-addon2">

                                            <button class="btn btn-outline-secondary" type="submit"
                                                id="button-addon2">Buscar</button>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group mb-6">
                                            {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-plus-circle-fill"></i></span> --}}

                                            <a href="{{ route('reactivo.create') }}" class="btn btn-success">Nuevo</a>
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
                                        <th>Nomenclatura</th>
                                        <th>Cantidad Disponible</th>
                                        <th>Fecha de adquisicion</th>
                                        <th>Fecha de caducidad</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($reactivo as $reac)
                                        <tr>
                                            <td class='text-center'>{{ $reac->id_reactivo }}</td>
                                            <td>{{ $reac->nombre_reactivo }}</td>
                                            <td>{{ $reac->nomenclatura }}</td>
                                            <td>{{ $reac->cantidad_disponible }}</td>
                                            <td>{{ $reac->fecha_adquisicion }}</td>
                                            {{--  <td><img src="{{asset('imagenes/reactivos/'.$reac->hoja_seguridad)}}" alt=""></td> --}}
                                            <td>{{ $reac->fecha_caducidad }}</td>
                                            <td>
                                                <button type="button" class="" href="" onclick="verMas({{ $reac->id_reactivo }}, '{{$reac->tipo}}','{{$reac->descripcion}}','{{$reac->condiciones}}','{{$reac->hoja_seguridad}}')">ver mas</button>
                                                <a href="{{ route('reactivo.edit', $reac->id_reactivo) }}"
                                                    class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                                <!-- Button trigger for danger theme modal -->
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteReactivoConfirmation({{ $reac->id_reactivo }})"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                        @include('reactivos.reactivo.modal')
                                        @include('reactivos.reactivo.modalMas')

                                    @endforeach

                                </tbody>
                            </table>
                            {{ $reactivo->links() }}

                        </div>
                    </div>
                </div>
            </div>
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
    </section>

    <!-- Hoverable rows end -->
@endsection
