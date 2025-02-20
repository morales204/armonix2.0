<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARMONIX | Dashboard</title>

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('generalStyles.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/home') }}" class="nav-link">Inicio</a>
                </li>
            </ul>

            <!-- Buscar -->
            <ul class="navbar-nav ml-auto">
                <form id="search-form" action="{{ route('search.global') }}" method="GET">
                    <input type="text" name="search" placeholder="Buscar..." required>
                    <select name="instrument_type">
                        <option value="">Seleccionar tipo de instrumento</option>
                        @foreach($instrumentTypes as $instrumentType)
                        <option value="{{ $instrumentType->id }}">{{ $instrumentType->name }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Buscar</button>
                </form>


            </ul>


            <li id="notificaciones-link" class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">1</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-4"></i>1
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Sidebar -->
        <aside class="main-sidebar elevation-4">
            <a href="{{ url('/home') }}" class="brand-link">
                <img src="https://png.pngtree.com/element_our/sm/20180415/sm_5ad31d9b53530.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8;">
                <span class="brand-text font-weight-dark text-dark">{{ auth()->user()->username }}</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        @if (auth()->user()->roles_id_rol === 1)
                        <li class="nav-item {{ request()->is('prestamos/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('prestamos/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>Cursos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                @foreach($instrumentTypes as $instrumentType)
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-music"></i>
                                        <p>
                                            {{ $instrumentType->name }}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>

                                    <ul class="nav nav-treeview">
                                        @foreach($instrumentType->instruments as $instrument)
                                        <li class="nav-item has-treeview">
                                            <a href="#" class="nav-link">
                                                <i class="nav-icon fas fa-chalkboard"></i>
                                                <p>
                                                    {{ $instrument->name }}
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>

                                            <ul class="nav nav-treeview">
                                                @foreach($instrument->courses as $course)
                                                <li class="nav-item">
                                                    <a href="#" class="nav-link course-link" data-url="{{ route('course.contents', ['courseId' => $course->id]) }}">
                                                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                                        <p>{{ $course->name }}</p>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                                <li class="nav-item">
                                    <a href="{{ route('cursos.agregar') }}" class="nav-link">
                                        <i class="nav-icon fas fa-plus-circle"></i>
                                        <p>Agregar Curso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.cursos.cursoslist') }}" class="nav-link">
                                        <i class="nav-icon fas fa-list-alt"></i>
                                        <p>Lista de Cursos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="{{ route('admin.cursos.cursoslist') }}" class="nav-link">
                                <i class="nav-icon fas fa-list-alt"></i>
                                <p>Lista de Cursos</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Contenido -->
        <div class="content-wrapper">
            <div id="course-content">
                @yield('content') <!-- Este es el contenido que se cargará dinámicamente -->
            </div>
        </div>
    </div>

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Versión</b> 3.0.0
        </div>
        <strong>Copyright &copy; 2022 <a href="https://www.example.com">Armonix</a>.</strong> Todos los derechos reservados.
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboard3.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-select.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.course-link').on('click', function(e) {
                e.preventDefault();
                let url = $(this).data('url');

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#course-content').html(data);
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo cargar el contenido del curso.'
                        });
                    }
                });
            });
        });

        $(document).ready(function() {
    // Función para realizar la búsqueda con la URL actual
    function fetchResults(queryString) {
        $.ajax({
            url: '{{ route("search.global") }}',
            method: 'GET',
            data: queryString,
            success: function(response) {
                $('#result-container').html(response);
                console.log('Respuesta JSON:', response);
            },
            error: function(xhr) {
                console.error(xhr);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se pudo realizar la búsqueda.'
                });
            }
        });
    }

    // Verificar si hay parámetros en la URL y hacer la búsqueda al cargar la página
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.toString()) {
        fetchResults(urlParams.toString());
    }

    $('#search-form').on('submit', function(e) {
        e.preventDefault();

        // Obtener los datos del formulario
        const formData = $(this).serialize();
        const newUrl = '{{ route("search.global") }}?' + formData;

        // Actualizar la URL
        window.history.pushState({ path: newUrl }, '', newUrl);

        // Recargar la página para que la petición quede registrada en DevTools
        location.reload();
    });
});



    </script>
</body>

</html>