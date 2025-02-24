<!-- resources/views/auth/passwords/recover.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Recuperar Contraseña') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.recover') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="secret_answer" class="form-label">{{ __('Respuesta a la pregunta secreta') }}</label>
                            <input id="secret_answer" type="text" class="form-control @error('secret_answer') is-invalid @enderror" name="secret_answer" required>
                            @error('secret_answer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Recuperar Contraseña') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
