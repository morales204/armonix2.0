@extends('layouts.admin')

@section('template_title')
    {{ $notasPremium->name ?? __('Show') . " " . __('Notas Premium') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Notas Premium</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('notas-premium.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Id Notap:</strong>
                                    {{ $notasPremium->id_notaP }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Nombre Notap:</strong>
                                    {{ $notasPremium->nombre_notaP }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Contenido Notap:</strong>
                                    {{ $notasPremium->contenido_notaP }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
