@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cursos Agregados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Cursos agregados</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Cursos Section -->
    <section class="section">
        <div class="container">
            <form action="{{ route('cursoslistAdd.index') }}" method="get" class="mb-3">
                <div class="input-group">
                    <select class="form-select" name="tipo">
                        <option value="nombre">Nombre</option>
                        <option value="fecha_inicio">Fecha inicio</option>
                        <option value="descripcion">Descripción</option>
                    </select>
                    <input type="text" name="buscar" class="form-control" placeholder="Buscar curso...">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                            <th>Instrumento</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cursos as $index => $curso)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $curso->name }}</td>
                                <td>{{ $curso->description }}</td>
                                <td>{{ $curso->created_at }}</td>
                                <td>{{ $curso->updated_at }}</td>
                                <td>{{ $curso->instrument->name ?? 'No asignado' }}</td>
                                <td>
                                    @if ($curso->image)
                                        <img src="{{ asset('storage/' . $curso->image) }}" width="50" height="50" class="img-thumbnail">
                                    @else
                                        No disponible
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="#" method="POST" style="display:inline;">
                                        
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este curso?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection
