@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Editar familia {{ $familia->tipo }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action=" {{ route('familia.update', $familia->id_familia) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="tipo">Nombre</label>
                    <input type="text" class="form-control" name="tipo" id="tipo" value="{{$familia->tipo}}"
                    placeholder="Ingresa el nombre de la familia">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
