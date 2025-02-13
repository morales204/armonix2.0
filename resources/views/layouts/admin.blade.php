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
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
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
            </div>
        </li>

        {{-- maximizar pantalla --}}
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <!-- Formulario de búsqueda en el navbar (con el modal) -->
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#searchModal">
                <i class="fas fa-search"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                Cerrar Sesion
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Modal de búsqueda -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Resultados de Búsqueda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <!-- Formulario de búsqueda dentro del modal -->
                <form id="search-form" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search" name="search" id="search-input">
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>

                <!-- Resultados de búsqueda -->
                <div id="search-results">
                    <!-- Aquí se mostrarán los resultados sin recargar la página -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>





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
                                    <a  href="#" onclick="loadMisCursos(event)"
                                        class="nav-link {{ request()->is('cursos/miscursos') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-user-graduate"></i>
                                        <p>Mis cursos</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a  href="#" onclick="loadCursos(event)"
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
                                    <a href="#" onclick="loadMetronomo(event)"
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
                                    <a href="{{ route('notas-premium.index') }}"
                                        class="nav-link {{ request()->is('notaP') ? 'active' : '' }}">
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
            <section class="content" id="content">
                <div class="container-fluid">

                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1 class="m-0">Mis cursos</h1>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Inicio</a></li>
                                        <li class="breadcrumb-item active">Mis cursos</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>


                    <section class="section">
                        <div class="row" id="table-hover-row">
                            <div class="col-12">
                                <div class="card">
                                    
                                    {{-- CABEZERA DEL CARD --}}
                                    <div class="card-header" id="card-header">
            

                                    </div>

                                    {{-- CONTENIDO DEL CARD --}}
                                    <div class="card-content mt-4">
                                        {{-- DETALLES DEL CARD INICIAL --}}
                                        <div class="row d-flex justify-content-center" id="cursos-container">
                                            {{--Aqui se incrustan los cards mediante JS--}}
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section> 

                    <!-- @yield('content') -->

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
        
    <!-- Bootstrap JS y Popper.js (necesarios para el modal) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita que se envíe el formulario de manera tradicional

    const searchQuery = document.getElementById('search-input').value; // Obtén el valor del input de búsqueda

    if (searchQuery.trim() === '') {
        document.getElementById('search-results').innerHTML = '<p>No hay resultados disponibles.</p>';
        return;
    }

    // Realiza la solicitud AJAX con fetch
    fetch("{{ route('admin.usuarios') }}?search=" + encodeURIComponent(searchQuery), {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.json()) // Asegúrate de que el servidor devuelva JSON
    .then(data => {
        const resultsContainer = document.getElementById('search-results');
        resultsContainer.innerHTML = ''; // Limpia los resultados previos

        if (data.results && data.results.length > 0) {
            data.results.forEach(item => {
                let resultItem = document.createElement('div');
                resultItem.classList.add('result-item', 'p-3', 'border', 'mb-3');

                if (item.type === 'nota') {
                    resultItem.innerHTML = `
                        <p><strong>Nombre de la nota: </strong> ${item.nombre_nota}</p>
                        <p><strong>Contenido de la nota: </strong> ${item.contenido_nota}</p>
                    `;
                } else if (item.type === 'usuario') {
                    resultItem.innerHTML = `
                        <p><strong>Nombre: </strong> ${item.nombre_completo}</p>
                        <p><strong>Username: </strong> ${item.username}</p>
                    `;
                }

                resultsContainer.appendChild(resultItem);
            });
        } else {
            resultsContainer.innerHTML = '<p>No se encontraron resultados.</p>';
        }
    })
    .catch(error => {
        console.error('Error en la búsqueda:', error);
        document.getElementById('search-results').innerHTML = '<p>Error al realizar la búsqueda.</p>';
    });
});

function loadMisCursos(event) {
    event.preventDefault(); // Evita la recarga de la página
    
    let url = "{{ route('miscursos.index') }}";

    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function () {
            $("#cursos-container").html('<div class="text-center"><i class="fas fa-spinner fa-spin fa-3x"></i><p>Cargando...</p></div>');
        },
        success: function (res) {
            let cardHeader = $('#card-header')
            cardHeader.html("");

            let buscador =`
                        <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                            <option value="nombre">Nombre</option>
                            <option value="fecha_inicio">Fecha inicio</option>
                            <option value="descripcion">Descripcion</option>
                        </select>

                        <input type="text" name="buscar" id="buscar">
                        <button class="btn btn-outline-success" onclick="searchMisCursos()" id="buscar">Buscar</button>
            `
            cardHeader.append(buscador);
            let cursosContainer = $("#cursos-container");
                cursosContainer.html(""); // Limpiar resultados previos

                if(res.cursos.data.length > 0){
                    res.cursos.data.forEach(function(curso){
                        let cursoHtml = `
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow h-100 py-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <h5 class="font-weight-bold">${curso.nombre}</h5>
                                    <span class="badge">
                                    ${curso.descripcion}
                                    </span>
                                </div>
                                <hr>
                                <p class="text-muted mb-1">Fecha: ${curso.fecha_inicio}</p>
                                <p class="text-muted">Horario: ${curso.fecha_fin}</p>
                                <div class="text-center">
                                <button class="button_slide slide_down" onclick="verDetallesMisCursos(${curso.id_curso })">
                                                        Ver más detalles
                                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
                        cursosContainer.append(cursoHtml);
                    });
                } else {
                    cursosContainer.html("<p class='text-center'>No se encontraron cursos.</p>");
                }
        },
        error: function () {
            alert("Error al cargar la página.");
        }
    });
}


function loadCursos(event) {
    event.preventDefault(); // Evita la recarga de la página
    
    let url = "{{ route('cursoslist.index') }}";

    $.ajax({
        url: url,
        type: "GET",
        dataType: "JSON",
        beforeSend: function () {
            $("#cursos-container").html('<div class="text-center"><i class="fas fa-spinner fa-spin fa-3x"></i><p>Cargando...</p></div>');
        },
        success: function (res) {
            let cardHeader = $('#card-header')
            cardHeader.html("");

            let buscador =`
                        <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                                <option value="nombre">Nombre</option>
                                <option value="instrumento">Instrumento</option>
                                <option value="descripcion">Descripcion</option>
                            </select>

                            <input type="text" name="buscar" id="buscar">
                            <button class="btn btn-outline-success" onclick="searchCursos()" id="buscar">Buscar</button>
            `
            cardHeader.append(buscador);
            let cursosContainer = $("#cursos-container");
                cursosContainer.html(""); // Limpiar resultados previos

                if(res.cursos.data.length > 0){
                    res.cursos.data.forEach(function(curso){
                        let cursoHtml = `
                            <div class="col-xl-10 col-md-12 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        ${curso.nombre}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    ${curso.descripcion}</div>
                                                        <span class="badge badge-success">${curso.instrumento}</span>
                                        
                                                </div>
                                                <div class="col-auto">
                                                    <i class="text-gray-300">
                                                    <button class="button_slide slide_down" onclick="verDetalles(${curso.id})">
                                                        Ver más detalles
                                                    </button>

                                                    </i>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        cursosContainer.append(cursoHtml);
                    });
                } else {
                    cursosContainer.html("<p class='text-center'>No se encontraron cursos.</p>");
                }
        },
        error: function () {
            alert("Error al cargar la página.");
        }
    });
}
    

    window.onpopstate = function () {
        $.ajax({
            url: window.location.href,
            type: "GET",
            dataType: "html",
            success: function (data) {
                $("#content").html($(data).find("#content").html());
            }
        });
    };

function searchMisCursos(){
        let buscar = $("#buscar").val();
        let tipo = $("#tipo").val();

        $.ajax({
            url: "{{route ('miscursos.index')}}",
            method: 'GET',
            data: {buscar: buscar, tipo: tipo},
            dataType: 'json',
            success: function(res){
                let cursosContainer = $("#cursos-container");
                cursosContainer.html(""); 

                if(res.cursos.data.length > 0){
                    res.cursos.data.forEach(function(curso){
                        let cursoHtml = `
                            <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
                                <div class="card shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="text-center">
                                            <h5 class="font-weight-bold">${curso.nombre}</h5>
                                            <span class="badge">${curso.descripcion}</span>
                                        </div>
                                        <hr>
                                        <p class="text-muted mb-1">Fecha: ${curso.nombre}</p>
                                        <p class="text-muted">Horario: ${curso.fecha_fin}</p>
                                        <div class="text-center">
                                            <button class="button_slide slide_down" onclick="verDetalles( ${curso.id_curso })">
                                                        Ver más detalles
                                                    </button>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        cursosContainer.append(cursoHtml);
                    });
                } else {
                    cursosContainer.html("<p class='text-center'>No se encontraron cursos.</p>");
                }
            }
        });
    }


function searchCursos (){
        let buscar = $("#buscar").val();
        let tipo = $("#tipo").val();

        $.ajax({
            url: "{{route ('cursoslist.index')}}",
            method: 'GET',
            data: {buscar: buscar, tipo: tipo},
            dataType: 'json',
            success: function(res){
                let cursosContainer = $("#cursos-container");
                cursosContainer.html(""); 

                if(res.cursos.data.length > 0){
                    res.cursos.data.forEach(function(curso){
                        let cursoHtml = `
                            <div class="col-xl-10 col-md-12 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                        ${curso.nombre}</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                    ${curso.descripcion}</div>
                                                        <span class="badge badge-success">${curso.instrumento}</span>
                                        
                                                </div>
                                                <div class="col-auto">
                                                    <i class="text-gray-300">
                                                    <button class="button_slide slide_down" onclick="verDetalles(${curso.id})">
                                                        Ver más detalles
                                                    </button>

                                                    </i>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        cursosContainer.append(cursoHtml);
                    });
                } else {
                    cursosContainer.html("<p class='text-center'>No se encontraron cursos.</p>");
                }
            }
        });
    }
    
    function verDetallesMisCursos(id) {
    fetch(`/cursos/miscursos/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Crear el HTML del modal dinámicamente
                let modalHtml = `
                    <div class="modal fade" id="cursoModal" tabindex="-1" aria-labelledby="cursoModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="cursoModalLabel">${data.curso.nombre}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Descripción:</strong> ${data.curso.descripcion}</p>
                                    <p><strong>Duración:</strong> ${data.curso.duracion}</p>
                                    <p><strong>Fecha de inicio:</strong> ${data.curso.fecha_inicio}</p>
                                    <p><strong>Fecha de fin:</strong> ${data.curso.fecha_fin}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Eliminar cualquier modal previo para evitar duplicados
                let existingModal = document.getElementById('cursoModal');
                if (existingModal) {
                    existingModal.remove();
                }

                // Insertar el modal en el body
                document.body.insertAdjacentHTML('beforeend', modalHtml);

                // Mostrar el modal
                $('#cursoModal').modal('show');

            } else {
                alert("No se encontraron detalles del curso.");
            }
        })
        .catch(error => console.error("Error al obtener detalles:", error));
}

function loadMetronomo(event) {
    event.preventDefault(); // Previene la recarga de la página

    // Realiza la petición AJAX
    $.ajax({
        url: '/herramientas/metronomo', // Asegúrate de que la ruta esté bien definida
        method: 'GET',
        success: function(response) {
            $('#cursos-container').html(response); // Inyecta la respuesta en el contenedor
        },
        error: function() {
            alert('Hubo un error al cargar el metrónomo');
        }
    });
}


    </script>
</body>

</html>