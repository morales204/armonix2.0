<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ARMONIX | Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('generalStyles.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-select.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <!-- Include SweetAlert CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Precarga -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="https://png.pngtree.com/element_our/sm/20180415/sm_5ad31d9b53530.jpg" alt="AdminLTELogo" height="150" width="150">
        </div>

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
                <form action="{{ route('search.global') }}" method="GET">
                    <input type="text" name="search" placeholder="Buscar..." required>

                    <!-- Select para filtrar por tipo de instrumento -->
                    <select name="instrument_type">
                        <option value="">Todos los tipos</option>
                        @foreach($instrumentTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>

                    <button type="submit">Buscar</button>
                </form>
            </ul>


            <!--  -->

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
            <a href="index3.html" class="brand-link">
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
                                                <i class="nav-icon fas fa-music "></i>
                                                <p>
                                                    {{ $instrument->name }}
                                                    <i class="right fas fa-angle-left"></i>
                                                </p>
                                            </a>

                                            <ul class="nav nav-treeview">
                                                @foreach($instrument->courses as $course)
                                                <li class="nav-item">
                                                    <a href="{{ route('course.contents', ['courseId' => $course->id]) }}" class="nav-link">
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
                                        <i class="nav-icon fas fa-plus-circle"></i>
                                        <p>Cursos Agregados</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: rgb(241, 250, 246)">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2024-2025 <a href="">Ek'Balam</a>.</strong>
            Todos los derechos reservados
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 0.0.1
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>
    <!-- ./wrapper -->

    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    @stack('scripts')
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

</body>

</html>