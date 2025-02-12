@extends('layouts.admin')

@section('template_title')
    Notas Premium
@endsection

@section('content')
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
                                    {{ __('Create New') }}
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
                                        <th>No</th>
                                        <th>Id Notap</th>
                                        <th>Nombre Notap</th>
                                        <th>Contenido Notap</th>
                                        <th></th>
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
                                                        <a class="btn btn-sm btn-primary" href="{{ route('notas-premium.show', $nota->id_notaP) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('notas-premium.edit', $nota->id_notaP) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
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
                                                        <a class="btn btn-sm btn-primary" href="{{ route('notas-premium.show', $nota->id_notaP) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('notas-premium.edit', $nota->id_notaP) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
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
