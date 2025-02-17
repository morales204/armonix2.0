@extends('layouts.admin')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Agregar curso</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Agregar curso</li>
                </ol>
            </div>
        </div>
    </div>

<div class="container">


    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="instrument_id" class="form-label">Instrumento</label>
            <select class="form-control @error('instrument_id') is-invalid @enderror" id="instrument_id" name="instrument_id" required>
                <option value="">Seleccione un instrumento</option>
                @foreach($instruments as $instrument)
                <option value="{{ $instrument->id }}">{{ $instrument->name }}</option>
                @endforeach
            </select>
            @error('instrument_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nombre del Curso</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
                <label for="image" class="form-label">Imagen</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                <div id="image-preview" class="mt-2"></div>
                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        <button type="submit" class="btn btn-primary">Guardar Curso</button>
    </form>
</div>
</div>
<script>
        document.getElementById('image').addEventListener('change', function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let imgPreview = document.createElement('img');
                    imgPreview.src = e.target.result;
                    imgPreview.style.width = '200px';
                    imgPreview.style.borderRadius = '10px';
                    imgPreview.style.marginTop = '10px';

                    let previewContainer = document.getElementById('image-preview');
                    previewContainer.innerHTML = ''; // Limpiar previas
                    previewContainer.appendChild(imgPreview);
                };
                reader.readAsDataURL(file);
            }
        });
</script>
@endsection
