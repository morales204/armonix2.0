<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- ------LLAMADAS A CARPETAS--------- -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="{{asset('js/script.js')}}"></script>

    
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body class="antialiased">
 {{--  <div class="">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/home') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div> --}}

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">

            <a class="navbar-brand" href="#">ARMONIX</a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">


                    @auth
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/home') }}">Inicio</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Inicia Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrate</a>
                        </li>

                    @endauth
                </ul>

            </div>
        </div>

    </nav>

    <!-- CAROUSEL -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/mus1.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Músicas</h5>
                    <p>Conces una gran variedad de musicas</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/mus3.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>Herramientas</h5>
                    <p>Una gran variedad de herramientas en un solo lugar</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/mus2.jpg') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h5>ARMONIX</h5>
                    <p></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- --------------------------------------------------- -->

    <!---------------- Experiencia ------------------------------>
    <section class="experiencia seccion-clara">
        <div class="container text-center">
            <div class="row">
                <!-- Herramientas Musicales -->
                <div class="columna col-12 col-md-4">
                    <i class="bi bi-music-note-list"></i>
                    <p class="experiencia-titulo">Herramientas</p>
                    <p>Explora nuestra colección de herramientas para músicos, desde software de edición hasta metrónomos y afinadores en línea.</p>
                    <div class="badges-contenedor">
                        <span class="badge">Edición de Audio</span>
                        <span class="badge">Afinadores</span>
                        <span class="badge">Loops y Samples</span>
                    </div>
                </div>
                <!-- Renta de Equipo e Instrumentos -->
                <div class="columna col-12 col-md-4">
                    <i class="bi bi-speaker"></i>
                    <p class="experiencia-titulo">Renta de Equipo</p>
                    <p>Ofrecemos servicio de renta de instrumentos musicales y equipo de sonido para tus presentaciones y eventos.</p>
                    <div class="badges-contenedor">
                        <span class="badge">Instrumentos</span>
                        <span class="badge">Audio Profesional</span>
                        <span class="badge">Iluminación</span>
                    </div>
                </div>
                <!-- Cursos de Música -->
                <div class="columna col-12 col-md-4">
                    <i class="bi bi-headphones"></i>
                    <p class="experiencia-titulo">Cursos</p>
                    <p>Aprende música con nuestros cursos diseñados para principiantes y profesionales. Mejora tu técnica y teoría musical con expertos.</p>
                    <div class="badges-contenedor">
                        <span class="badge">Guitarra</span>
                        <span class="badge">Producción Musical</span>
                        <span class="badge">Composición</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ----------------------------------------------------- -->

    <!-- --------------------Contacto-------------------- -->
    <section id="contacto" class="contacto seccion-oscura">
        <div class="container">
            <div class="container text-center rectangulo d-flex justify-content-evenly">
                <div class="row">
                    <div class="col-12 col-md-4 seccion-titulo">
                        ¡Hablemos!
                    </div>
                    <div class="col-12 col-md-4 descripcion">
                        Contáctame para iniciar tu proyecto de desarrollo web y haré que tu visión se vuelva realidad.
                    </div>
                    <div class="col-12 col-md-4">
                        <a href="mailto:devcraft@gmail.com">
                            <button type="button">
                                Contacto
                                <i class="bi bi-envelope-check-fill"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ----------------------------------------------------- -->

    <!-- Pie de pagina (footer) -->
    <footer class="seccion-oscura d-flex flex-column align-items-center justify-content-center">
        <!-- <img class="footer-logo" src="{{asset('img/logo2.png')}}" alt="Logo del portafolio"> -->
        <img class="footer-logo" src="{{asset('img/armonix.jpg')}}" alt="Logo del portafolio">
        <p class="footer-texto text-center">Cursos, herremientas y mas.<br>Creemos un proyecto juntos.</p>
        <div class="iconos-redes-sociales d-flex flex-wrap align-items-center justify-content-center">
            <a href="#" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="#" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-github"></i>
            </a>
            <a href="#" target="_blank"
                rel="noopener noreferrer">
                <i class="bi bi-linkedin"></i>
            </a>
            <!-- <a href="" target="_blank" rel="noopener noreferrer">
            <i class="bi bi-instagram"></i>
          </a> -->
            <a href="mailto:programblog77@gmail.com" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-envelope"></i>
            </a>
        </div>
        <div class="derechos-de-autor">EK´BALAM (2024) &#169;</div>
    </footer>

</body>

</html>
