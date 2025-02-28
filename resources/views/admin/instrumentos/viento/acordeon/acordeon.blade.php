@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Acordeón</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/cursos/instrumentos') }}">Cursos</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/cursos/acordeon') }}">Instrumentos de Viento</a></li>
                        <li class="breadcrumb-item active">Acordeón</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

     <!-- Main content -->
     <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        @foreach ($cursos as $curso)
                        <!-- Card 1 -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card">
                                <img src="{{ $curso->imagen }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $curso->nombre }}</h5>
                                    <p class="card-text"></p>
                                    <a href="#" class="btn btn-primary">Ir</a>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="c   ontainer-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
    <!-- Cursos Section End -->
@endsection
