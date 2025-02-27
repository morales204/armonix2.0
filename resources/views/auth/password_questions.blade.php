@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Recuperación de Contraseña por Preguntas Secretas') }}</div>

                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="{{ route('password.verify.answers') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ $user->email }}">

                    <!-- Mostrar el correo electrónico del usuario -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico:</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                    </div>

                    <!-- Pregunta secreta 1 -->
                    <div class="mb-3">
                        <label for="secret_answer" class="form-label">Pregunta 1: {{ $user->secret_question }}</label>
                        <input type="text" class="form-control @error('secret_answer') is-invalid @enderror" id="secret_answer" name="secret_answer" required>
                        @error('secret_answer')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Pregunta secreta 2 -->
                    <div class="mb-3">
                        <label for="secret_answer_2" class="form-label">Pregunta 2: {{ $user->secret_question_2 }}</label>
                        <input type="text" class="form-control @error('secret_answer_2') is-invalid @enderror" id="secret_answer_2" name="secret_answer_2" required>
                        @error('secret_answer_2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-dark">
                                {{ __('Verificar') }}
                            </button>
                            <a href="{{ route('password.recovery.form') }}" class="btn btn-link">
                                {{ __('Volver') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
