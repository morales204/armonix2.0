<div class="container">
    <select class="form-select" name="tipo" id="tipo">
        <option value="nombre">Nombre</option>
        <option value="fecha_inicio">Fecha inicio</option>
        <option value="descripcion">Descripción</option>
    </select>

    <input type="text" name="buscar" id="buscar">
    <button class="btn btn-outline-success" onclick="search()">Buscar</button>

    <div class="row" id="cursos-container">
        @foreach ($cursos as $curso)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <div class="text-center">
                            <h5 class="font-weight-bold">{{ $curso->nombre }}</h5>
                            <span class="badge">{{ $curso->descripcion }}</span>
                        </div>
                        <hr>
                        <p class="text-muted mb-1">Fecha: {{ $curso->fecha_inicio }}</p>
                        <p class="text-muted">Horario: {{ $curso->fecha_fin }}</p>
                        <div class="text-center">
                            <button class="button_slide slide_down" onclick="verDetalles({{ $curso->id_curso }})">
                                Ver más detalles
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $cursos->links() }}
</div>
