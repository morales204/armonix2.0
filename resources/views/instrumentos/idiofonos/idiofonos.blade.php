<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- TITULO DE LA PAGINA WEB --}}
    <title>UNILAB | Dashboard</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('generalStyles.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-select.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}"> --}}
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

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>



</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Precarga -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/logo2.png') }}" alt="AdminLTELogo" height="150"
                width="150">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
            <!-- Navbar izquierdo links -->
            <ul class="navbar-nav">
                {{-- Icono de menú --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>

                {{-- Inicio --}}
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/home') }}" class="nav-link">Inicio</a>
                </li>

                {{-- Breadcrumb --}}
                <li class="nav-item d-none d-sm-inline-block">
                    <span class="nav-link">/</span>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/cursos') }}" class="nav-link">Cursos</a>
                </li>   
                <li class="nav-item d-none d-sm-inline-block">
                    <span class="nav-link">/</span>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/idiofonos') }}" class="nav-link">Idiofonos</a>
                </li>    
            </ul>


            <!-- Navbar derecho links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
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

                </li>

                {{-- maximizar pantalla --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <!-- Icono de cierre de sesión (puedes cambiarlo según tus preferencias) -->
                        Cerrar Sesion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('img/logo2.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8;">
                <span class="brand-text font-weight-dark">{{ auth()->user()->username }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-item {{ request()->is('prestamos/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->is('prestamos/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Cursos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <!-- Instrumentos de viento -->
                                <li class="nav-item has-treeview">
                                    <a href="{{ url('/viento') }}" class="nav-link">
                                        <i class="nav-icon fas fa-saxophone"></i>
                                        <p>
                                            Instrumentos de viento
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('/acordeon') }}" class="nav-link">
                                                <i class="nav-icon fas fa-acordion"></i>
                                                <p>Acordeon</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/trompeta') }}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Trompeta</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/tuba') }}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Tuba</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Instrumentos de cuerda -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-guitar"></i>
                                        <p>
                                            Instrumentos de cuerda
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('/cuerda/guitarra') }}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Guitarra</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/cuerda/violin') }}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Violín</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Idiófonos -->
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-history"></i>
                                        <p>
                                            Idiófonos
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('/xilofono') }}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Xilofono</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/castañuela') }}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Castañuela</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/campana') }}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Campana</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>


                        </li>

                        @if (auth()->user()->roles_id_rol === 1)
                        <!-- Mostrar contenido para laboratoristas -->
                        @endif
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="background-color: rgb(241, 250, 246)">

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Card 1 -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('img/viento.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Xilofono</h5>
                                    <p class="card-text"></p>
                                    <a href="{{ url('/xilofono')}}" class="btn btn-primary">Ir</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('img/viento.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Castañuela</h5>
                                    <p class="card-text"></p>
                                    <a href="{{ url('/castañuela')}}" class="btn btn-primary">Ir</a>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('img/viento.png') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Campana</h5>
                                    <p class="card-text"></p>
                                    <a href="{{ url('/campana')}}" class="btn btn-primary">Ir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="c   ontainer-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024-2025 <a href="">DevCraft</a>.</strong>
            Todos los derechos reservados
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 0.0.1
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap-select.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    @stack('scripts')
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    {{-- <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}



</body>

</html>