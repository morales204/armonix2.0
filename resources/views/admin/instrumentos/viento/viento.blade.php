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
                    <li class="breadcrumb-item"><a href="{{ route('instrumentos.index') }}">Cursos</a></li>
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
            @if($instruments->isEmpty())
            <div class="col-12">
                <p class="text-muted">No hay instrumentos disponibles en esta categoría.</p>
            </div>
            @else
            @foreach($instruments as $instrument)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card">
                <img src="{{ asset('img/' . $instrument->image) }}" alt="{{ $instrument->name }}" width="100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $instrument->name }}</h5>

                        <!-- Botón para ver cursos del instrumento -->
                        <a href="{{ route('instrument.courses', ['id' => $instrument->id]) }}"
                            class="btn btn-primary mt-2">
                            Ver Cursos
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
@endsection