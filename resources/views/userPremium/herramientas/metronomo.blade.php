@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Metrónomo</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Metrónomo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Metrónomo -->
    <div class="container mt-5">


        <!-- Funcionalidad del metrónomo -->
        <div class="container">
            
            <button id="startStopBtn" class="btn btn-primary">Iniciar</button>

            <div class="tempo-control">
                <label for="tempoRange">Tempo (BPM): </label>
                <input type="range" id="tempoRange" min="40" max="200" value="120">
                <span id="tempoValue">120 BPM</span>
            </div>
        </div>

        <!-- Sección de funciones de pago -->
        <div class="card mb-4 mt-5">
            <div class="card-header">
                Gracias por confiar en nosotros!...
                <span class="float-right text-danger"><i class="fa-solid fa-unlock-keyhole"></i> ¡Compra ahora!</span>
            </div>
            <div class="card-body">
                <p><strong><i class="fas fa-star"></i> Sonido Personalizado</strong> - Elige entre diferentes sonidos para tu metrónomo.</p>
                <p><strong><i class="fas fa-star"></i> Visualización Avanzada</strong> - Gráficos y visualizaciones avanzadas del ritmo.</p>
                <p><strong><i class="fas fa-star"></i> Modo silencioso</strong> - Utiliza el metrónomo sin sonido, solo con vibración.</p>
            </div>
        </div>

        <!-- Botón de compra (Solo premium) -->
        <div class="text-center">
            <button class="btn btn-warning btn-lg">
                <i class="fas fa-lock"></i> ¡Obtén Funciones Premium!
            </button>
        </div>
    </div>
@endsection

@section('styles')
    <!-- Añadir iconos de FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
            text-align: center;
        }
        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .button:disabled {
            background-color: #ddd;
            cursor: not-allowed;
        }
        .functions-premium {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
        .premium {
            color: #ff9800;
        }
        .lock-icon {
            color: red;
        }
        .tempo-control {
            margin-top: 15px;
        }
        .tempo-control input {
            width: 100%;
            margin: 5px 0;
            padding: 5px;
        }
    </style>
@endsection

@section('scripts')
    <script>
        let isPlaying = false;
        let tempo = 120;
        let audioContext = new (window.AudioContext || window.webkitAudioContext)();
        let oscillator;

        // Elementos DOM
        const startStopBtn = document.getElementById('startStopBtn');
        const tempoRange = document.getElementById('tempoRange');
        const tempoValue = document.getElementById('tempoValue');

        // Función para iniciar y detener el metrónomo
        startStopBtn.addEventListener('click', () => {
            if (isPlaying) {
                stopMetronome();
            } else {
                startMetronome();
            }
        });

        // Cambiar tempo
        tempoRange.addEventListener('input', (e) => {
            tempo = e.target.value;
            tempoValue.textContent = `${tempo} BPM`;
        });

        // Iniciar el metrónomo
        function startMetronome() {
            isPlaying = true;
            startStopBtn.textContent = 'Detener';
            playBeat();
        }

        // Detener el metrónomo
        function stopMetronome() {
            isPlaying = false;
            startStopBtn.textContent = 'Iniciar';
            clearInterval(oscillator);
        }

        // Reproducir un latido (beat) del metrónomo
        function playBeat() {
            const interval = (60 / tempo) * 1000; // Tiempo entre beats en milisegundos

            oscillator = setInterval(() => {
                const osc = audioContext.createOscillator();
                osc.connect(audioContext.destination);
                osc.frequency.setValueAtTime(440, audioContext.currentTime); // Frecuencia de 440Hz (la nota La)
                osc.start();
                osc.stop(audioContext.currentTime + 0.1); // Duración del latido
            }, interval);
        }
    </script>
@endsection
