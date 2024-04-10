@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Registrar reactivo</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action=" {{ route('reactivo.store') }}" method="POST" enctype="multipart/form-data" class="form">
            @csrf
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="nombre_reactivo">Nombre del reactivo</label>
                            <input type="text"  class="form-control @error('nombre_reactivo') is-invalid @enderror"  required id="nombre_reactivo" name="nombre_reactivo"
                                placeholder="Ingresa el nombre del reactivo" value="{{ old('nombre_reactivo') }}">
                                @error('nombre_reactivo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="cantidad_disponible">Cantidad disponible</label>
                            <input type="number" class="form-control @error('cantidad_disponible') is-invalid @enderror" required id="cantidad_disponible" name="cantidad_disponible"
                                placeholder="1" value="{{ old('cantidad_disponible') }}" min="1">
                                @error('cantidad_disponible')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="hoja_seguridad">Hoja de seguridad</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('hoja_seguridad') is-invalid @enderror" id="hoja_seguridad" name="hoja_seguridad" onchange="updateLabel(this)">
                                <label class="custom-file-label" for="hoja_seguridad" >Seleccionar archivo</label>
                                @error('hoja_seguridad')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <script>
                                // Función para actualizar la etiqueta label con el nombre del archivo seleccionado
                                function updateLabel(input) {
                                    var fileName = input.files[0].name;
                                    var label = input.nextElementSibling;
                                    label.innerText = fileName;
                                }
                            </script>
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="nomenclatura">Nomenclatura</label>
                            <input type="text" class="form-control @error('nomenclatura') is-invalid @enderror" required  id="nomenclatura" name="nomenclatura"
                                placeholder="Ingrese una nomenclatura del reactivo" value="{{ old('nomenclatura') }}">
                                @error('nomenclatura')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_adquisicion">Fecha de adquisicion</label>
                            <input type="datetime-local" class="form-control @error('fecha_adquisicion') is-invalid @enderror" required id="fecha_adquisicion" name="fecha_adquisicion" 
                            min="{{ now()->subWeeks(2)->format('Y-m-d\TH:i') }}" value="{{ old('fecha_adquisicion') }}">
                            @error('fecha_adquisicion')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="fecha_caducidad">Fecha de caducidad</label>
                            <input type="datetime-local" class="form-control @error('fecha_caducidad') is-invalid @enderror" required id="fecha_caducidad" name="fecha_caducidad" value="{{ old('fecha_caducidad') }}">
                            @error('fecha_caducidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="familias_id_familia">Familia</label>
                            <select name="familias_id_familia" id="familias_id_familia" class="form-control @error('familias_id_familia') is-invalid @enderror" >
                                @foreach ($familias as $familia)
                                    <option value="{{ $familia->id_familia }}">{{ $familia->tipo }}</option>
                                @endforeach
                            </select>
                            @error('familias_id_familia')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="nivel_peligrosidad_id_nivel_peligrosidad">Nivel de peligrosidad</label>
                            <select name="nivel_peligrosidad_id_nivel_peligrosidad" id="nivel_peligrosidad_id_nivel_peligrosidad" class="form-control">
                                @foreach ($nivel_peligrosidad as $nivel)
                                    <option value="{{ $nivel->id_nivel_peligrosidad }}">{{ $nivel->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2 col-12">
                        <div class="form-group">
                            <label for="condiciones_almacenamiento_id_condiciones_almacenamiento">Condiciones de almacenamiento</label>
                            <select name="condiciones_almacenamiento_id_condiciones_almacenamiento" id="condiciones_almacenamiento_id_condiciones_almacenamiento" class="form-control">
                                @foreach ($condiciones_almacenamiento as $condiciones)
                                    <option value="{{ $condiciones->id_condiciones_almacenamiento }}">{{ $condiciones->condiciones }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button onclick="window.history.back();"  type="reset" class="btn btn-danger">Cancelar</button>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
