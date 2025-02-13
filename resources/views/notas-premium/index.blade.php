@extends('layouts.admin')

@section('template_title')
    Notas Premium
@endsection

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Notas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Herramientas</a></li>
                        <li class="breadcrumb-item active"><a href="/notas-premium">Notas</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Notas Premium') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('notas-premium.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    {{ __('Crear Nuevo') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <!-- Mostrar el término de búsqueda solo si existe -->
                    @if(isset($searchTerm))
                        <div class="alert alert-info">
                            <p>Resultados para: <strong>{{ $searchTerm }}</strong></p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Número</th>
                                        <th>Nombre</th>
                                        <th>Contenido</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Mostrar resultados de búsqueda -->
                                    @if(isset($searchTerm) && $notasPremium->isNotEmpty())
                                        @foreach($notasPremium as $nota)
                                            <tr>
                                                <td>{{ $nota->id_notaP }}</td>
                                                <td>{{ $nota->nombre_notaP }}</td>
                                                <td>{{ $nota->contenido_notaP }}</td>
                                                <td>
                                                    <form action="{{ route('notas-premium.destroy', $nota->id_notaP) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary" href="{{ route('notas-premium.show', $nota->id_notaP) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver más') }}</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('notas-premium.edit', $nota->id_notaP) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    <!-- Si no hay término de búsqueda, mostrar todas las notas -->
                                    @else
                                        @foreach ($notasPremium as $nota)
                                            <tr>
                                                <td>{{ $nota->id_notaP }}</td>
                                                <td>{{ $nota->nombre_notaP }}</td>
                                                <td>{{ $nota->contenido_notaP }}</td>
                                                <td>
                                                    <form action="{{ route('notas-premium.destroy', $nota->id_notaP) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary" href="{{ route('notas-premium.show', $nota->id_notaP) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver más') }}</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('notas-premium.edit', $nota->id_notaP) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('¿Estas segur@ de borrar esta nota?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $notasPremium->links() !!}
            </div>
        </div>
    </div>
@endsection
