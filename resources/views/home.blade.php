@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @php
                    $rol = DB::table('roles')->where('id_rol', auth()->user()->roles_id_rol)->value('rol');
                    @endphp
                
                    <p>{{ __('Bienvenido') }}, {{ auth()->user()->username }}!</p>
                    <p>{{ __('Your role is') }}: {{$rol}}</p>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
