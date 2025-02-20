@extends('layouts.admin')

@section('content')
<style>
  /* Efectos en las cards */
  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
  }

  .card:hover {
    transform: scale(1.05);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  }

  /* Efecto en los iconos */
  .card i {
    font-size: 50px;
    color: #007bff;
    transition: transform 0.3s ease, color 0.3s ease;
  }

  .card:hover i {
    transform: rotate(15deg);
    color: #0056b3;
  }
  
</style>

<div class="container">
  <!-- Carrusel -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($instrumentTypes as $key => $instrument)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($instrumentTypes as $key => $instrument)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <a href="{{ route('instrumentos.viento', ['id' => $instrument->id]) }}">
                    <img src="{{ asset($instrument->image) }}" class="d-block w-100 img-fluid" style="max-height: 300px; object-fit: cover;" alt="{{ $instrument->name }}">
                </a>
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $instrument->name }}</h5>
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
  </div>

  <!-- Cards con iconos y efectos -->
  <div class="row mt-4 justify-content-center">
    <!-- Card 1: Instrumentos de viento -->
    <div class="col-md-4 d-flex justify-content-center">
      <div class="card">
        <i class="fas fa-wind p-4"></i>
        <div class="card-body">
          <h5 class="card-title">Instrumentos de Viento</h5>
          <p class="card-text">Explora los instrumentos de viento que forman parte de nuestra oferta educativa.</p>
          <a href="{{ route('instrumentos.viento', ['id' => 1]) }}" class="btn btn-primary">Ver Más</a>
        </div>
      </div>
    </div>

    <!-- Card 2: Instrumentos de cuerdas -->
    <div class="col-md-4 d-flex justify-content-center">
      <div class="card">
        <i class="fas fa-guitar p-4"></i>
        <div class="card-body">
          <h5 class="card-title">Instrumentos de Cuerdas</h5>
          <p class="card-text">Descubre los instrumentos de cuerdas y aprende más sobre ellos.</p>
          <a href="{{ route('instrumentos.viento', ['id' => 2]) }}" class="btn btn-primary">Ver Más</a>
        </div>
      </div>
    </div>

    <!-- Card 3: Instrumentos de percusión -->
    <div class="col-md-4 d-flex justify-content-center">
      <div class="card">
        <i class="fas fa-drum p-4"></i>
        <div class="card-body">
          <h5 class="card-title">Instrumentos de Percusión</h5>
          <p class="card-text">Conoce los instrumentos de percusión, fundamentales para la música.</p>
          <a href="{{ route('instrumentos.viento', ['id' => 3]) }}" class="btn btn-primary">Ver Más</a>
        </div>
      </div>
    </div>
</div>

@endsection
