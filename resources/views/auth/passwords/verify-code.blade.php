@extends('layouts.app')

@section('cssLogin')
    <!-- Importa la hoja de estilo de la sección -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleLogin.css') }}">
    <style>
        /* Estilos para las cajas del código */
        .input-code {
            width: 50px;
            height: 50px;
            text-align: center;
            font-size: 24px;
            margin: 5px;
            border: 2px solid #ccc;
            border-radius: 10px;
            transition: border-color 0.3s ease;
        }

        .input-code:focus {
            border-color: #007bff;
            outline: none;
        }

        .input-group {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        /* Estilo para el temporizador */
        .timer {
            font-size: 16px;
            color: #333;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Estilo para los botones */
        .btn-custom {
            width: 150px;
            height: 45px;
            font-size: 16px;
            border-radius: 25px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        /* Estilos para los mensajes */
        .alert {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Verificar código de recuperación</div>

                <div class="card-body">
                    <!-- Mostrar los mensajes de sesión (si existen) -->
                    @if(session('message'))
                        <div class="alert alert-info">{{ session('message') }}</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <!-- Reloj del tiempo de vida del código -->
                    <div class="timer" id="timer">
                        El código caduca en: <span id="timeRemaining">02:00</span>
                    </div>

                    <!-- Verificar código de recuperación Formulario -->
                    <form method="POST" action="{{ route('password.verify_code') }}" id="verification-form">
                        @csrf
                        <input type="hidden" name="phone" value="{{ $phone }}">
                        <div class="input-group">
                            <!-- Cajitas para los 6 dígitos del código -->
                            <input type="text" name="code1" id="code1" class="input-code" maxlength="1" autofocus>
                            <input type="text" name="code2" id="code2" class="input-code" maxlength="1">
                            <input type="text" name="code3" id="code3" class="input-code" maxlength="1">
                            <input type="text" name="code4" id="code4" class="input-code" maxlength="1">
                            <input type="text" name="code5" id="code5" class="input-code" maxlength="1">
                            <input type="text" name="code6" id="code6" class="input-code" maxlength="1">
                        </div>

                        <div class="d-flex justify-content-start">
                            <!-- Botón para verificar el código -->
                            <button type="submit" class="btn btn-primary btn-custom">Verificar código</button>
                            
                            <!-- Opción para regresar -->
                            <a href="{{ route('password.recover-password') }}" class="btn btn-secondary btn-custom">Regresar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Manejo del foco y navegación entre las cajas
    document.querySelectorAll('.input-code').forEach((element, index, arr) => {
        element.addEventListener('input', () => {
            if (element.value.length === 1 && index < arr.length - 1) {
                arr[index + 1].focus();
            }
        });
    });

    // Temporizador para la expiración del código (2 minutos)
    let timeRemaining = 120;
    const timerElement = document.getElementById('timeRemaining');
    
    function updateTimer() {
        let minutes = Math.floor(timeRemaining / 60);
        let seconds = timeRemaining % 60;
        if (seconds < 10) seconds = '0' + seconds;
        timerElement.textContent = `${minutes}:${seconds}`;
        
        if (timeRemaining > 0) {
            timeRemaining--;
        } else {
            clearInterval(timerInterval);
            alert('El código ha expirado.');
        }
    }
    
    const timerInterval = setInterval(updateTimer, 1000);
</script>

@endsection
