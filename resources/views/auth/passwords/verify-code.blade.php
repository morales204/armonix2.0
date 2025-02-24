@extends('layouts.app')
@section('cssLogin')
    <!-- Importa la hoja de estilo de la sección -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleLogin.css') }}">
@endsection
@section('content')
<div class="container">
    <h2>Verificar código de recuperación</h2>

    <form method="POST" action="{{ route('password.verify_code') }}">
        @csrf
        <input type="hidden" name="phone" value="{{ $phone }}">
        <div class="form-group">
            <label for="recovery_code">Código de recuperación</label>
            <input type="text" class="form-control" name="recovery_code" id="recovery_code" placeholder="Ingresa el código de recuperación">
        </div>

        <button type="submit" class="btn btn-primary">Verificar código</button>
    </form>

    @if(session('message'))
        <div class="alert alert-info">{{ session('message') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</div>
@endsection
