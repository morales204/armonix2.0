@extends('layouts.admin')

@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Registrar usuario</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action=" {{ route('usuario.store') }}" method="POST" class="form">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo</label>
                    <input type="text" class="form-control @error('nombre_completo') is-invalid @enderror"
                        id="nombre_completo" name="nombre_completo" value="{{ old('nombre_completo') }}"
                        placeholder="Ingresa el nombre completo del usuario">
                    @error('nombre_completo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="number" class="form-control @error('telefono') is-invalid @enderror" id="telefono"
                        name="telefono" value="{{ old('telefono') }}"
                        placeholder="Ingrese el numero de telefono a 10 dígitos">
                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" class="form-control  @error('correo') is-invalid @enderror" id="correo"
                        name="correo" placeholder="Ingrese un correo electronico" value="{{ old('correo') }}">
                    @error('correo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="username">Nombre de usuario</label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" placeholder="Ingrese el nombre de usuario" value="{{ old('username') }}">
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="roles_id_rol">Rol</label>
                    <select name="roles_id_rol" id="roles_id_rol" class="form-control">
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->id_rol }}">{{ $rol->rol }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tipo">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Ingrese una contraseña" value="{{ old('password') }}">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tipo">Confirmar contraseña</label>
                    <input type="password" class="form-control @error('password_confirm') is-invalid @enderror"
                        id="password_confirm" name="password_confirmation" placeholder="Repita la contraseña">
                    @error('password_confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

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
