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
                            <label for="correo" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electrónico') }}</label>

                            <div class="col-md-6">
                                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo">

                                @error('correo')
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
                            
                            {{--  <input id="roles_id_rol" type="select" class="form-control @error('roles_id_rol') is-invalid @enderror" name="roles_id_rol" required autocomplete="roles_id_rol"> --}}

                                <select name="roles_id_rol" id="roles_id_rol" class="form-control">
                                    <option value="2">Cliente Free</option>
                                    <option value="3">Cliente Premium</option>
                                    <option value="4">Cliente Publicitario</option>
                                    
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="{{ old('password') }}">

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
                        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        <div class="row mb-3">
                            <label for="pregunta_secreta_1" class="col-md-4 col-form-label text-md-end">Selecciona la primera pregunta:</label>
                            <div class="col-md-6">
                                <select name="pregunta_secreta_1" id="pregunta_secreta_1" required class="form-control" onchange="filtrarPreguntas()">
                                    <option value="¿Cuál es el nombre de tu primera mascota?">¿Cuál es el nombre de tu primera mascota?</option>
                                    <option value="¿En qué ciudad naciste?">¿En qué ciudad naciste?</option>
                                    <option value="¿Cuál es tu comida favorita?">¿Cuál es tu comida favorita?</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="respuesta_secreta_1" class="col-md-4 col-form-label text-md-end">Respuesta:</label>
                            <div class="col-md-6">
                                <input type="text" name="respuesta_secreta_1" required class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="pregunta_secreta_2" class="col-md-4 col-form-label text-md-end">Selecciona la segunda pregunta:</label>
                            <div class="col-md-6">
                                <select name="pregunta_secreta_2" id="pregunta_secreta_2" required class="form-control">
                                    <option value="¿Cuál es el nombre de tu primera mascota?">¿Cuál es el nombre de tu primera mascota?</option>
                                    <option value="¿En qué ciudad naciste?">¿En qué ciudad naciste?</option>
                                    <option value="¿Cuál es tu comida favorita?">¿Cuál es tu comida favorita?</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="respuesta_secreta_2" class="col-md-4 col-form-label text-md-end">Respuesta:</label>
                            <div class="col-md-6">
                                <input type="text" name="respuesta_secreta_2" required class="form-control">
                            </div>
                        </div>
                    


                        <!-- Aviso de privacidad -->
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input @error('aviso-privacidad') is-invalid @enderror" type="checkbox" id="aviso-privacidad" name="aviso-privacidad">
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
            <p><strong>1. Responsable del Tratamiento de Datos Personales</strong></p>
    <p>ARMONIX, con domicilio en Ocosingo, es el responsable del tratamiento de sus datos personales conforme a lo establecido en este aviso de privacidad.</p>

    <p><strong>2. Datos Personales Recabados</strong></p>
    <p>Los datos personales que podemos recabar incluyen, entre otros:</p>
    <ul>
        <li>Nombre completo</li>
        <li>Correo electrónico</li>
        <li>Número telefónico</li>
        <li>Dirección</li>
        <li>Datos bancarios (en caso de transacciones)</li>
        <li>Cualquier otro dato necesario para la prestación de nuestros servicios</li>
    </ul>

    <p><strong>3. Finalidad del Tratamiento de Datos</strong></p>
    <p>Los datos personales recabados serán utilizados para las siguientes finalidades:</p>
    <ul>
        <li>Brindar los servicios y productos solicitados</li>
        <li>Procesar pagos y facturación</li>
        <li>Enviar información relevante sobre nuestros servicios</li>
        <li>Mejorar la experiencia del usuario en nuestra plataforma</li>
        <li>Cumplir con obligaciones legales</li>
    </ul>

    <p><strong>4. Protección y Almacenamiento de Datos</strong></p>
    <p>Implementamos medidas de seguridad para proteger su información contra accesos no autorizados, alteraciones, pérdidas o uso indebido.</p>

    <p><strong>5. Compartición de Datos Personales</strong></p>
    <p>No compartiremos sus datos personales con terceros sin su consentimiento, salvo en los siguientes casos:</p>
    <ul>
        <li>Cuando sea requerido por una autoridad competente</li>
        <li>Para cumplir con obligaciones legales</li>
        <li>Con proveedores de servicios que apoyen en la operación de la página web (ej. hosting, procesadores de pago)</li>
    </ul>

    <p><strong>6. Derechos ARCO (Acceso, Rectificación, Cancelación y Oposición)</strong></p>
    <p>Usted tiene derecho a acceder, rectificar, cancelar u oponerse al tratamiento de sus datos personales. Para ejercer estos derechos, puede contactarnos a través del correo electrónico <strong>ejemplo@gmail.com</strong>, proporcionando la información necesaria para atender su solicitud.</p>

    <p><strong>7. Uso de Cookies y Tecnologías Similares</strong></p>
    <p>Nuestra página web puede utilizar cookies para mejorar la experiencia del usuario. Puede configurar su navegador para bloquear o eliminar las cookies si así lo desea.</p>

    <p><strong>8. Cambios al Aviso de Privacidad</strong></p>
    <p>Nos reservamos el derecho de modificar este aviso de privacidad en cualquier momento. Cualquier cambio será publicado en esta misma sección de nuestra página web.</p>

    <p><strong>9. Contacto</strong></p>
    <p>Si tiene alguna duda sobre este aviso de privacidad, puede comunicarse con nosotros a través del correo <strong>ejemplo@gmail.com</strong> o en nuestra dirección <strong>2a Norte Sur Poniente</strong>.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cerrar') }}</button>
            </div>
        </div>
    </div>
</div>


<script>
    function filtrarPreguntas() {
        var pregunta1 = document.getElementById('pregunta_secreta_1').value;
        var pregunta2 = document.getElementById('pregunta_secreta_2');

        // Restablecer opciones
        var opciones = pregunta2.getElementsByTagName('option');
        for (var i = 0; i < opciones.length; i++) {
            opciones[i].style.display = 'block';
        }

        // Ocultar la opción seleccionada en la primera pregunta
        for (var i = 0; i < opciones.length; i++) {
            if (opciones[i].value === pregunta1) {
                opciones[i].style.display = 'none';
                if (pregunta2.value === pregunta1) {
                    pregunta2.value = ""; // Reiniciar si la opción estaba seleccionada
                }
            }
        }
    }
</script>
@endsection

