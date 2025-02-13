
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
                Funciones Premium
                <span class="float-right text-danger"><i class="fas fa-lock"></i> ¡Compra ahora!</span>
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
