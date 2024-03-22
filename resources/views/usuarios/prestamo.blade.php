@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Realizar prestamo</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="card-body">
                <div class="row">


                    
                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="familias_id_familia">Materia</label>
                            <select name="familias_id_familia" id="familias_id_familia" class="form-control">
                                @foreach ($familias as $familia)
                                    <option value="{{ $familia->id_familia }}">{{ $familia->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="nomenclatura">Unidad Tematica</label>
                            <input type="text" class="form-control" id="nomenclatura" name="nomenclatura"
                                placeholder="Ingrese una nomenclatura del reactivo">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nombre_reactivo">Introducion</label>
                            <input type="text" class="form-control" id="nombre_reactivo" name="nombre_reactivo"
                                placeholder="Ingresa el nombre del reactivo">
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nombre_reactivo">Objetivo</label>
                            <input type="text" class="form-control" id="nombre_reactivo" name="nombre_reactivo"
                                placeholder="Ingresa el nombre del reactivo">
                        </div>
                    </div>


                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="cantidad_disponible">Grado y grupo</label>
                            <input type="number" class="form-control" id="cantidad_disponible" name="cantidad_disponible"
                                placeholder="0">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="nivel_peligrosidad_id_nivel_peligrosidad">Carrera</label>
                            <select name="nivel_peligrosidad_id_nivel_peligrosidad" id="nivel_peligrosidad_id_nivel_peligrosidad" class="form-control">
                                @foreach ($nivel_peligrosidad as $nivel)
                                    <option value="{{ $nivel->id_nivel_peligrosidad }}">{{ $nivel->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_adquisicion">Fecha y hora de inicio</label>
                            <input type="datetime-local" class="form-control" id="fecha_adquisicion" name="fecha_adquisicion">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_caducidad">Fecha y hora de fin</label>
                            <input type="datetime-local" class="form-control" id="fecha_caducidad" name="fecha_caducidad">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_caducidad">Numero de practica</label>
                            <input type="datetime-local" class="form-control" id="fecha_caducidad" name="fecha_caducidad">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_caducidad">Titulo de la practica</label>
                            <input type="datetime-local" class="form-control" id="fecha_caducidad" name="fecha_caducidad">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_caducidad">Fecha de prestamo</label>
                            <input type="datetime-local" class="form-control" id="fecha_caducidad" name="fecha_caducidad">
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="condiciones_almacenamiento_id_condiciones_almacenamiento">Laboratorio</label>
                            <select name="condiciones_almacenamiento_id_condiciones_almacenamiento" id="condiciones_almacenamiento_id_condiciones_almacenamiento" class="form-control">
                                @foreach ($condiciones_almacenamiento as $condiciones)
                                    <option value="{{ $condiciones->id_condiciones_almacenamiento }}">{{ $condiciones->condiciones }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="hoja_seguridad">Responsable/Docente</label>
                            <input type="file" class="form-control" id="hoja_seguridad" name="hoja_seguridad">
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
