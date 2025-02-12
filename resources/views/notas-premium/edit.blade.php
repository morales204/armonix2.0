@extends('layouts.admin')

@section('template_title')
    {{ __('Update') }} Notas Premium
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Notas</h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Herramientas</a></li>
                        <li class="breadcrumb-item active"><a href="/notas-premium">Notas</a></li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('notas-premium.edit', $notasPremium->id_notaP) }}">
                                Editar
                            </a>
                        </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Modificar') }} Nota Premium</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('notas-premium.update', $notasPremium->id_notaP) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('notas-premium.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
