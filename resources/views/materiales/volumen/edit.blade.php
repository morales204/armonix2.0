@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Editar volumen {{ $volumen->volumen }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action=" {{ route('volumen.update', $volumen->id_volumen) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="tipo">volumen</label>
                    <input type="text" class="form-control" name="volumen" id="volumen" value="{{$volumen->volumen}}"
                    placeholder="Ingresa el nombre del volumen">
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
