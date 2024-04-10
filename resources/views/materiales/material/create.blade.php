@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Registrar material</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action=" {{ route('material.store') }}" method="POST" class="form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="tipo">Nombre material</label>
                    <input type="text"  class="form-control @error('nombre_material') is-invalid @enderror" id="nombre_material" name="nombre_material"
                        placeholder="Ingresa el nombre del material" value="{{ old('nombre_material') }}" required>
                        @error('nombre_material')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="tipo">Cantidad disponible</label>
                    <input type="number"  class="form-control @error('cantidad_disponible') is-invalid @enderror" id="cantidad_disponible" name="cantidad_disponible"
                        placeholder="1" value="{{ old('cantidad_disponible') }}" required min="1">
                        @error('cantidad_disponible')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="tipo">Descripcion</label>
                    <input type="text" class="form-control @error('descripcion') is-invalid @enderror"   required id="descripcion" name="descripcion"
                        placeholder="Ingrese una descripcion del material" value="{{ old('descripcion') }}" >
                        @error('descripcion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>

                <div class="form-group">
                    <label for="tipo">Volumen</label>
                    <select name="volumenes_id_volumen" id="volumenes_id_volumen">
                        @foreach ( $volumenes as $volumen )
                            <option value="{{$volumen->id_volumen}}">{{$volumen->volumen}}</option>
                        @endforeach
                    </select>
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
