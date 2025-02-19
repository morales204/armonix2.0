¡@extends('layouts.admin')

@section('content')
<div class="container mt-4">
  <h3>Instrumentos de tipo: {{ $instrumentType->name }}</h3>
  <div class="row">
    @foreach ($instruments as $instrument)
    <div class="col-md-4">
      <div class="card">
        <img src="{{ asset($instrument->image) }}" class="card-img-top" alt="{{ $instrument->name }}">
        <div class="card-body">
          <h5 class="card-title">{{ $instrument->name }}</h5>
          <p class="card-text">{{ $instrument->description }}</p>
          <a href="{{ route('instrument.courses', ['id' => $instrument->id]) }}"
                            class="btn btn-primary mt-2">
                            Ver Cursos
                        </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
