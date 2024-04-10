@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Editar reactivo</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action=" {{ route('reactivo.update',$reactivo->id_reactivo) }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nombre_reactivo">Nombre del reactivo</label>
                            <input type="text" class="form-control" id="nombre_reactivo" name="nombre_reactivo"
                                placeholder="Ingresa el nombre del reactivo" value="{{$reactivo->nombre_reactivo}}">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="cantidad_disponible">Cantidad disponible</label>
                            <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible"
                                placeholder="0" value="{{$reactivo->cantidad_disponible}}">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="hoja_seguridad">Hoja de seguridad</label>
                            <input type="file" class="form-control" id="hoja_seguridad" name="hoja_seguridad">
                            @if ($reactivo->hoja_seguridad != "")
                            <a href="{{ asset('pdf/reactivos/'.$reactivo->hoja_seguridad) }}" target="_blank">Ver PDF</a>

                                
                            @endif
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="nomenclatura">Nomenclatura</label>
                            <input type="text" class="form-control" id="nomenclatura" name="nomenclatura"
                                placeholder="Ingrese una nomenclatura del reactivo"
                                value="{{$reactivo->nomenclatura}}">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_adquisicion">Fecha de adquisicion</label>
                            <input type="datetime-local" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion"
                            value="{{$reactivo->fecha_adquisicion}}">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_caducidad">Fecha de caducidad</label>
                            <input type="datetime-local" class="form-control" id="fecha_caducidad" name="fecha_caducidad"
                            value="{{$reactivo->fecha_caducidad}}">
                        </div>
                    </div>


                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="familias_id_familia">Familia</label>
                            <select name="familias_id_familia" id="familias_id_familia" class="form-control">
                                @foreach ($familias as $familia)
                                @if ($familia->id_familia == $reactivo->familias_id_familia)
                                    <option value="{{ $familia->id_familia }}" selected>{{ $familia->tipo }}</option>
                                    
                                @else
                                <option value="{{ $familia->id_familia }}">{{ $familia->tipo }}</option>
                                    
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="nivel_peligrosidad_id_nivel_peligrosidad">Nivel de peligrosidad</label>
                            <select name="nivel_peligrosidad_id_nivel_peligrosidad" id="nivel_peligrosidad_id_nivel_peligrosidad" class="form-control">
                                @foreach ($nivel_peligrosidad as $nivel)
                                @if ($nivel->id_nivel_peligrosidad == $reactivo->nivel_peligrosidad_id_nivel_peligrosidad)
                                    <option value="{{ $nivel->id_nivel_peligrosidad }}"selected>{{ $nivel->descripcion }}</option>
                                @else
                                    <option value="{{ $nivel->id_nivel_peligrosidad }}">{{ $nivel->descripcion }}</option>
                                @endif
                    
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="condiciones_almacenamiento_id_condiciones_almacenamiento">Condiciones de almacenamiento</label>
                            <select name="condiciones_almacenamiento_id_condiciones_almacenamiento" id="condiciones_almacenamiento_id_condiciones_almacenamiento" class="form-control">
                                @foreach ($condiciones_almacenamiento as $condiciones)
                                @if ($condiciones->id_condiciones_almacenamiento == $reactivo->condiciones_almacenamiento_id_condiciones_almacenamiento)
                                    <option value="{{ $condiciones->id_condiciones_almacenamiento }}" selected>{{ $condiciones->condiciones }}</option>
                                @else
                                    <option value="{{ $condiciones->id_condiciones_almacenamiento }}">{{ $condiciones->condiciones }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

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
