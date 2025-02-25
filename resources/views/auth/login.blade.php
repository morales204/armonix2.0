@extends('layouts.app')


@section('cssLogin')
    <!-- Importa la hoja de estilo de la sección -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleLogin.css') }}">
@endsection


@section('content')

<img class="wave" src=" {{asset('img/disco-vinilo.png')}} ">
<div class="container ">
    <div class="row justify-content-end" style="margin-top: 250px;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Inicio de sesion') }}</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="correo" class="col-md-4 col-form-label text-md-end">{{ __('Correo Electronico') }}</label>

                            <div class="col-md-6">
                                <input id="correo" type="email" class="form-control @error('correo') is-invalid @enderror" name="correo" value="{{ old('correo') }}" required autocomplete="correo" autofocus>

                                @error('correo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{--                         <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Iniciar sesion') }}
                                </button>
                                <div class="recovery-container">
    <a class="btn-link" onclick="toggleRecoveryOptions()">Recuperar contraseña</a>
    <div id="recovery-options" style="display: none;">
        <p>Selecciona un método para recuperar tu contraseña:</p>
        <ul>
            <li><a href="{{ route('verificarCorreo') }}">Pregunta secreta</a></li>
            @if (Route::has('password.request'))
                <li><a href="{{ route('password.request') }}">Recuperar por correo</a></li>
                <li><a href="{{ route('password.recover-password') }}">Recuperar por SMS</a></li>
            @endif
        </ul>
    </div>
</div>

<script>
    function toggleRecoveryOptions() {
        var options = document.getElementById('recovery-options');
        options.style.display = options.style.display === 'none' ? 'block' : 'none';
    }
</script>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="contenedor">

    <div class="img">
        <img src="">
    </div>

    <div class="login-content">

        <form action="" method="POST">
            @csrf

            <img src="">

            <h2 class="title">Bienvenido</h2>

            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-user"></i>
                </div>
                <div class="div">
                    <h5>Nombre de usuario</h5>
                    <input type="text" name='username' id='username' class="input">
                </div>
            </div>

            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Contraseña</h5>
                    <input type="password" name='password' id='password' class="input">
                </div>
            </div>

            <a href="#">Registrate</a>

            <div class="alert alert-danger" role="alert">
                This is a danger alert—check it out! 
              </div>

            <input type="submit" class="btn" value="Iniciar sesion">
        </form>

    </div>

</div> --}}
@endsection
