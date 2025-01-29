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

                    </div>

                    {{-- CONTENIDO DEL CARD --}}
                    <div class="card-content mt-4">
                        
                            {{-- DETALLES DEL CARD INICIAL --}}
                            <div class="row d-flex justify-content-center">
                                <!-- card 1 -->
                                <div class="col-xl-10 col-md-12 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        Mi primer curso</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        GuitarraVIVA</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">Del
                                                        15/02/25 al 18/02/25</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">De
                                                        7:20 a 8:00</div>

                                                        <span class="badge badge-success">En proceso</span>
                                                  
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
                            </div>
                    </div>
                

                </div>
            </div>
        </div>
    </section>
    <!-- Hoverable rows end -->
@endsection
