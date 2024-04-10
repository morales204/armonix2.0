@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Panel de Copias de Seguridad</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <a href="{{ route('respaldo.create')}}" class="btn btn-primary mb-3">Crear Backup</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Archivo</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($backups as $backup)
            <tr>
                <td>{{ basename($backup->path()) }}</td>
                <td>{{ $backup->date()->format('d/m/Y H:i:s') }}</td>
                <td>
                    <a href="{{ route('download',basename($backup->path()) ) }}" class="btn btn-primary" download>Descargar</a>
                    <form action="{{ route('respaldo.destroy',basename($backup->path()) )}}" method="post" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este respaldo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">No hay copias de seguridad disponibles.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
