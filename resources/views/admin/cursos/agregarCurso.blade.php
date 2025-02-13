@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Agregar Curso</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="instrument_id" class="form-label">Instrumento</label>
            <select class="form-control @error('instrument_id') is-invalid @enderror" id="instrument_id" name="instrument_id" required>
                <option value="">Seleccione un instrumento</option>
                @foreach($instruments as $instrument)
                    <option value="{{ $instrument->id }}" {{ old('instrument_id') == $instrument->id ? 'selected' : '' }}>
                        {{ $instrument->name }}
                    </option>
                @endforeach
            </select>
            @error('instrument_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Imagen (Opcional)</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar Curso</button>
    </form>
</div>
@endsection
