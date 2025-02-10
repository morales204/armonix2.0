@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $instrumentType->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('/cursos') }}">Cursos</a></li>
                        <li class="breadcrumb-item active">{{ $instrumentType->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @foreach($instruments as $instrument)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card">
                            <img src="{{ asset('img/default.png') }}" class="card-img-top" alt="{{ $instrument->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $instrument->name }}</h5>
                                <!-- Aquí puedes agregar más detalles si es necesario -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
