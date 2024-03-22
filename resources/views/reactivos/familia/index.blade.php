@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Listado de familias</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Familias</li>
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
                        <form action="{{ route('familia.index') }}" method="get">

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span> --}}
                                        
                                        <input type="text" class="form-control" name="texto" placeholder="Buscar familia" value="{{$texto}}" aria-label="Recipient's username" aria-describedby="button-addon2">

                                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group mb-6">
                                        {{-- <span class="input-group-text" id="basic-addon1"><i class="bi bi-plus-circle-fill"></i></span> --}}
                                        
                                        <a href="{{ route('familia.create') }}" class="btn btn-success">Nueva</a>
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
                                    <th>Id</th>
                                    <th>Tipo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($familia as $fam)

                                <tr>
                                    <td>{{ $fam->id_familia }}</td>
                                    <td>{{ $fam->tipo }}</td>
                                    <td>
                                        <a href="{{ route('familia.edit',$fam->id_familia) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        <!-- Button trigger for danger theme modal -->
                                        <button type="button" class="btn btn-outline-danger btn-sm"  onclick="deleteFamiliaConfirmation({{ $fam->id_familia }})"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                                @include('reactivos.familia.modal')
                                @endforeach

                            </tbody>
                        </table>
                        {{ $familia->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hoverable rows end -->
@endsection
