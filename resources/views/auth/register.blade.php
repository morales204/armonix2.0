@extends('layouts.app')

@section('cssLogin')
<!-- Importa la hoja de estilo de la sección -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/styleLogin.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrate') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="nombre_completo" class="col-md-4 col-form-label text-md-end">{{ __('Nombre completo') }}</label>

                            <div class="col-md-6">
                                <input id="nombre_completo" type="text" class="form-control @error('nombre_completo') is-invalid @enderror" name="nombre_completo" value="{{ old('nombre_completo') }}" autocomplete="nombre_completo" autofocus required>

                                @error('nombre_completo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="telefono" class="col-md-4 col-form-label text-md-end">{{ __('Teléfono') }}</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ old('telefono') }}" required autocomplete="telefono" autofocus>

                                @error('telefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Nombre de usuario') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required autocomplete="username" value="{{ old('username') }}">

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="roles_id_rol" class="col-md-4 col-form-label text-md-end">{{ __('Rol') }}</label>

                            <div class="col-md-6">
                                <select name="roles_id_rol" id="roles_id_rol" class="form-control">
                                    <option value="1" {{ old('roles_id_rol') == 1 ? 'selected' : '' }}>Admin</option>
                                    <option value="2" {{ old('roles_id_rol') == 2 ? 'selected' : '' }}>Cliente Free</option>
                                    <option value="3" {{ old('roles_id_rol') == 3 ? 'selected' : '' }}>Cliente Premium</option>
                                    <option value="4" {{ old('roles_id_rol') == 4 ? 'selected' : '' }}>Cliente Publicitario</option>
                                </select>

                                @error('roles_id_rol')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <!-- Pregunta secreta 1-->
                        <div class="row mb-3">
                            <label for="secret_question" class="col-md-4 col-form-label text-md-end">{{ __('Pregunta Secreta 1') }}</label>

                            <div class="col-md-6">
                                <select id="secret_question" name="secret_question" class="form-control @error('secret_question') is-invalid @enderror" required>
                                    <option value="">Selecciona una pregunta</option>
                                    <option value="¿Cuál es el nombre de tu mascota?" {{ old('secret_question') == '¿Cuál es el nombre de tu mascota?' ? 'selected' : '' }}>¿Cuál es el nombre de tu mascota?</option>
                                    <option value="¿En qué ciudad naciste?" {{ old('secret_question') == '¿En qué ciudad naciste?' ? 'selected' : '' }}>¿En qué ciudad naciste?</option>
                                    <option value="¿Cuál es el nombre de tu primera escuela?" {{ old('secret_question') == '¿Cuál es el nombre de tu primera escuela?' ? 'selected' : '' }}>¿Cuál es el nombre de tu primera escuela?</option>
                                    <option value="¿Cuál es el segundo nombre de tu madre?" {{ old('secret_question') == '¿Cuál es el segundo nombre de tu madre?' ? 'selected' : '' }}>¿Cuál es el segundo nombre de tu madre?</option>
                                    <option value="¿Cuál es tu deporte favorito?" {{ old('secret_question') == '¿Cuál es tu deporte favorito?' ? 'selected' : '' }}>¿Cuál es tu deporte favorito?</option>
                                </select>

                                @error('secret_question')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="secret_answer" class="col-md-4 col-form-label text-md-end">{{ __('Respuesta Secreta 1') }}</label>

                            <div class="col-md-6">
                                <input id="secret_answer" type="text" class="form-control @error('secret_answer') is-invalid @enderror" name="secret_answer" value="{{ old('secret_answer') }}" required autocomplete="off">

                                @error('secret_answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Pregunta secreta 2-->
                        <div class="row mb-3">
                            <label for="secret_question_2" class="col-md-4 col-form-label text-md-end">{{ __('Pregunta Secreta 2') }}</label>

                            <div class="col-md-6">
                                <select id="secret_question_2" name="secret_question_2" class="form-control @error('secret_question_2') is-invalid @enderror" required>
                                <option value="">Selecciona una pregunta</option>
                                    <option value="¿Cuál es el nombre de tu mascota?" {{ old('secret_question') == '¿Cuál es el nombre de tu mascota?' ? 'selected' : '' }}>¿Cuál es el nombre de tu mascota?</option>
                                    <option value="¿En qué ciudad naciste?" {{ old('secret_question') == '¿En qué ciudad naciste?' ? 'selected' : '' }}>¿En qué ciudad naciste?</option>
                                    <option value="¿Cuál es el nombre de tu primera escuela?" {{ old('secret_question') == '¿Cuál es el nombre de tu primera escuela?' ? 'selected' : '' }}>¿Cuál es el nombre de tu primera escuela?</option>
                                    <option value="¿Cuál es el segundo nombre de tu madre?" {{ old('secret_question') == '¿Cuál es el segundo nombre de tu madre?' ? 'selected' : '' }}>¿Cuál es el segundo nombre de tu madre?</option>
                                    <option value="¿Cuál es tu deporte favorito?" {{ old('secret_question') == '¿Cuál es tu deporte favorito?' ? 'selected' : '' }}>¿Cuál es tu deporte favorito?</option>
                                </select>

                                @error('secret_question_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="secret_answer_2" class="col-md-4 col-form-label text-md-end">{{ __('Respuesta Secreta 2') }}</label>

                            <div class="col-md-6">
                                <input id="secret_answer_2" type="text" class="form-control @error('secret_answer_2') is-invalid @enderror" name="secret_answer_2" value="{{ old('secret_answer_2') }}" required autocomplete="off">

                                @error('secret_answer_2')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <!-- Aviso de privacidad -->
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input @error('aviso-privacidad') is-invalid @enderror" type="checkbox" id="aviso-privacidad" name="aviso-privacidad" required>
                                    <label class="form-check-label" for="aviso-privacidad">
                                        {{ __('Acepto los') }} <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">{{ __('Avisos de privacidad') }}</a>
                                    </label>

                                    @error('aviso-privacidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrate') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para mostrar los Avisos de Privacidad -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">{{ __('Avisos de Privacidad') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí van los detalles de los Avisos de Privacidad -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
            </div>
        </div>
    </div>
</div>

@endsection