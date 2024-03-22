@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Editar material</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('material.update',$material->id_material) }}" method="POST" class="form">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="tipo">Nombre material</label>
                    <input type="text" class="form-control" id="nombre_material" name="nombre_material"
                        placeholder="Ingresa el nombre del material" value="{{ $material->nombre_material}}">
                </div>

                <div class="form-group">
                    <label for="tipo">Cantidad disponible</label>
                    <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible"
                        placeholder="0" value="{{ $material->cantidad_disponible}}">
                </div>

                <div class="form-group">
                    <label for="tipo">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                        placeholder="Ingrese una descripcion del material" value="{{ $material->descripcion}}">
                </div>

                <div class="form-group">
                    <label for="tipo">Volumen</label>
                    <select name="volumenes_id_volumen" id="volumenes_id_volumen">
                        @foreach ( $volumenes as $volumen )
                            @if ($volumen->id_volumen == $material->volumenes_id_volumen)
                            <option value="{{$volumen->id_volumen}}" selected>{{$volumen->volumen}}</option>
                            @else
                            <option value="{{$volumen->id_volumen}}">{{$volumen->volumen}}</option>
                                
                            @endif
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
