@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Mis cursos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Mis cursos</li>
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
                        <form action="{{ route('cursoslist.index') }}" method="get">
                            <select class="form-select" aria-label="Default select example" name="tipo">
                                <option value="nombre">Nombre</option>
                                <option value="instrumento">Instrumento</option>
                                <option value="descripcion">Descripcion</option>
                            </select>

                            <input type="text" name="buscar">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    </div>

                    {{-- CONTENIDO DEL CARD --}}
                    <div class="card-content mt-4">
                        
                            {{-- DETALLES DEL CARD INICIAL --}}
                            <div class="row d-flex justify-content-center">
                                <!-- card 1 -->
                                 @foreach ($cursos as $cursosInstrumentos)
                                <div class="col-xl-10 col-md-12 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        {{$cursosInstrumentos->nombre}}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    {{$cursosInstrumentos->descripcion}}</div>
                                                        <span class="badge badge-success">{{$cursosInstrumentos->instrumento}}</span>
                                        
                                                </div>
                                                <div class="col-auto">
                                                    <i class="text-gray-300">
                                                        <div id=""
                                                            class="button_slide slide_down">Ver mas
                                                            detalles</div>
                                                    </i>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            {{ $cursos->links() }}
                    </div>
                

                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->
@endsection
