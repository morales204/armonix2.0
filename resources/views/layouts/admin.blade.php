<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- TITULO DE LA PAGINA WEB --}}

    <title>ARMONIX | Dashboard</title>

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
            <img class="animation__shake" src="https://png.pngtree.com/element_our/sm/20180415/sm_5ad31d9b53530.jpg" alt="AdminLTELogo" height="150"
                width="150">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand">
            <!-- Navbar izquierdo links -->
            <ul class="navbar-nav">

                {{-- Icono de menu --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/home') }}" class="nav-link">Inicio</a>
                </li>
            </ul>

            <!-- Navbar derecho links -->
            <ul class="navbar-nav ml-auto">

                <!-- Notifications Dropdown Menu -->
                <li id="notificaciones-link" class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">{{$notificaciones->total}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @foreach ($notificaciones as $notificacion)
                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-4"></i>{{$notificacion->titulo}}
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>

                        <div class="dropdown-divider"></div>
                        @endforeach

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
                <img src="https://png.pngtree.com/element_our/sm/20180415/sm_5ad31d9b53530.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8;">
                <span class="brand-text font-weight-dark text-dark">{{ auth()->user()->username }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">


                        <!-- Mostrar apartado usuario Admin -->
                        @if (auth()->user()->roles_id_rol === 1)

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
                                            <a href="{{ route('acordeon.index') }}"
                                            class="nav-link {{ request()->is('viento/acordeon') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-acordion"></i>
                                                <p>Acordeon</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('trompeta.index') }}"
                                            class="nav-link {{ request()->is('viento/trompeta') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Trompeta</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('tuba.index') }}"
                                            class="nav-link {{ request()->is('viento/tuba') ? 'active' : '' }}">
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
                                            <a href="{{ url('/idiofono/xilofono')}}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Xilofono</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/idiofono/castañuela')}}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Castañuela</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/idiofono/campana')}}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Campana</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- Agregar curso -->
                                <li class="nav-item">
                                    <a href="{{ route('agregarcurso.index') }}"
                                        class="nav-link {{ request()->is('cursos/agregarcurso') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-graduate"></i>
                                        <p>Agregar curso</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('cursoslistAdd.index') }}"
                                        class="nav-link {{ request()->is('cursos/cursoslistAdd') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-graduate"></i>
                                        <p>Cursos Agregados</p>
                                    </a>
                                </li>
                            </ul>

                            <li class="nav-item nav-item {{ request()->is('servicios/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Servicios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('rentaInstrumento.index')}}" class="nav-link {{ request()->is('servicios/rentaInstrumento') ? 'active' : '' }}">
                                        <i class="fas fa-guitar nav-icon"></i>
                                        <p>Renta de Instrumentos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('rentaServicio.index')}}" class="nav-link {{ request()->is('servicios/rentaServicio') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase nav-icon"></i>
                                        <p>Renta de Servicios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>
                                          Usuarios
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ url('/agregar/usuario') }}" class="nav-link">
                                                <i class="nav-icon fas fa-plus"></i>
                                                <p>Agregar Usuario</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/gestionar/usuario') }}" class="nav-link">
                                                <i class="nav-icon fas fa-user"></i>
                                                <p>Usuarios</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            
                        </li>

                        @endif

                        <!-- Mostrar apartado usuario free -->
                        @if (auth()->user()->roles_id_rol === 2)

                        <li class="nav-item {{ request()->is('cursos/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Cursos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('miscursos.index') }}"
                                        class="nav-link {{ request()->is('cursos/miscursos') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-graduate"></i>
                                        <p>Mis cursos</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('cursoslist.index') }}"
                                        class="nav-link {{ request()->is('cursos/cursoslist') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-book-open"></i>
                                        <p>Ver cursos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ request()->is('herramientas/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p>
                                    Herramientas
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('metronomo.index') }}"
                                        class="nav-link {{ request()->is('herramientas/metronomo') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-headphones"></i>
                                        <p>Metrónomo</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('nota.index') }}"
                                        class="nav-link {{ request()->is('herramientas/nota') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-pencil-alt"></i>
                                        <p>Notas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item nav-item {{ request()->is('servicios/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Servicios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('rentaInstrumento.index')}}" class="nav-link {{ request()->is('servicios/rentaInstrumento') ? 'active' : '' }}">
                                        <i class="fas fa-guitar nav-icon"></i>
                                        <p>Renta de Instrumentos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('rentaServicio.index')}}" class="nav-link {{ request()->is('servicios/rentaServicio') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase nav-icon"></i>
                                        <p>Renta de Servicios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif


                        <!-- Mostrar apartado usuario free -->
                        @if (auth()->user()->roles_id_rol === 4)
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
                                            <a href="{{ route('acordeon.index') }}"
                                            class="nav-link {{ request()->is('viento/acordeon') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-acordion"></i>
                                                <p>Acordeon</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('trompeta.index') }}"
                                            class="nav-link {{ request()->is('viento/trompeta') ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Trompeta</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('tuba.index') }}"
                                            class="nav-link {{ request()->is('viento/tuba') ? 'active' : '' }}">
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
                                            <a href="{{ url('/idiofono/xilofono')}}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Xilofono</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/idiofono/castañuela')}}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Castañuela</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/idiofono/campana')}}" class="nav-link">
                                                <i class="nav-icon fas fa-music"></i>
                                                <p>Campana</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item nav-item {{ request()->is('servicios/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Servicios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('rentaInstrumento.index')}}" class="nav-link {{ request()->is('servicios/rentaInstrumento') ? 'active' : '' }}">
                                        <i class="fas fa-guitar nav-icon"></i>
                                        <p>Renta de Instrumentos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('rentaServicio.index')}}" class="nav-link {{ request()->is('servicios/rentaServicio') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase nav-icon"></i>
                                        <p>Renta de Servicios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('publicidad.index')}}" class="nav-link {{ request()->is('servicios/publicidad') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase nav-icon"></i>
                                        <p>Servicio de publicidad</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        @endif

                        <li class="nav-item">

                        <!-- Mostrar apartado usuario Premium -->
                        @if (auth()->user()->roles_id_rol === 3)

                        <li class="nav-item {{ request()->is('cursos/*') ? 'menu-open' : '' }}">

                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Cursos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('miscursos.index') }}"
                                        class="nav-link {{ request()->is('cursos/miscursos') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-graduate"></i>
                                        <p>Mis cursos</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('cursoslist.index') }}"
                                        class="nav-link {{ request()->is('cursos/cursoslist') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-book-open"></i>
                                        <p>Ver cursos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item {{ request()->is('herramientas/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p>
                                    Herramientas
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('metronomoP.index') }}"
                                        class="nav-link {{ request()->is('userP/herramientas/metronomoP') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-headphones"></i>
                                        <p>Metrónomo</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('notaP.index') }}"
                                        class="nav-link {{ request()->is('userP/herramientas/notaP') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-pencil-alt"></i>
                                        <p>Notas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item nav-item {{ request()->is('servicios/*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Servicios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('rentaInstrumento.index')}}" class="nav-link {{ request()->is('servicios/rentaInstrumento') ? 'active' : '' }}">
                                        <i class="fas fa-guitar nav-icon"></i>
                                        <p>Renta de Instrumentos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('rentaServicio.index')}}" class="nav-link {{ request()->is('servicios/rentaServicio') ? 'active' : '' }}">
                                        <i class="fas fa-briefcase nav-icon"></i>
                                        <p>Renta de Servicios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
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

                    @yield('content')

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024-2025 <a href="">Ek'Balam</a>.</strong>
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