<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hotel | Sistema de gestion</title>

    <link rel="stylesheet" href="/css/app.css">

</head>

<!-- transicion entre componentes -->
<style>
    .component-fade-enter {
        transform: translateY(-10px);
        opacity: 0;

    }

    .component-fade-enter-active,
    .component-fade-leave-active {
        transition: all 1s ease-in-out;
    }


    .component-fade-leave-to {
        transform: translateY(10px);
        opacity: 0;
    }

</style>

<body class="sidebar-mini control-sidebar-slide-open">
    <div id="app">

        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark navbar-navy">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    {{-- < <cambio></cambio>  --}}
                </ul>
                <ul class="navbar-nav ml-auto">
                    <Caja-icon />
                </ul>

            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar elevation-4 sidebar-dark-danger">
                <!-- Brand Logo -->
                <router-link to="/" class="brand-link navbar-navy">
                    <i class="fas fa-hotel fa-lg cyan brand-image img-circle elevation-3 pt-1"></i>
                    <span class="brand-text font-italic">Hotel Vito Primero</span>
                </router-link>


                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <i class="fa fa-user fa-lg red pt-2"></i>
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                {{ Auth::user()->name }}
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


                            <li class="nav-item">
                                <router-link to="/" class="nav-link">
                                    <i class="nav-icon fas fa-home blue"></i>
                                    <p>
                                        Inicio
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link :to="{ name : 'reserva'}" class="nav-link">
                                    <i class="nav-icon fas fa-calendar-alt yellow "></i>
                                    <p>
                                        Reservas
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link :to="{ name : 'cliente'}" class="nav-link">
                                    <i class="nav-icon fas fa-user-friends orange"></i>
                                    <p>
                                        Clientes
                                    </p>
                                </router-link>
                            </li>

                            @can('isAdmin')
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fa fa-cog green"></i>
                                    <p>
                                        Gestionar
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link :to="{ name : 'caja'}" class="nav-link">
                                            <i class="nav-icon fas fa-cash-register red"></i>
                                            <p>Cajas</p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'user'}" class="nav-link">
                                            <i class="far fa-circle nav-icon fas fa-user yellow"></i>
                                            <p>Usuarios</p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'tipoFactura'}" class="nav-link">
                                            <i class="nav-icon fas fa-paperclip teal"></i>
                                            <p>
                                                Tipos de facturas
                                            </p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'motivo'}" class="nav-link">
                                            <i class="nav-icon fas fa-plane green"></i>
                                            <p>
                                                Motivos de viaje
                                            </p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'marca'}" class="nav-link">
                                            <i class="nav-icon fab fa-amilia red"></i>
                                            <p>
                                                Marcas de productos
                                            </p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'precio'}" class="nav-link">
                                            <i class="nav-icon fas fa-dollar-sign cyan"></i>
                                            <p>
                                                Precios de la estadia
                                            </p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'categoria'}" class="nav-link">
                                            <i class="nav-icon fas fa-tags blue"></i>
                                            <p>
                                                Categorias de productos
                                            </p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'modoPago'}" class="nav-link">
                                            <i class="nav-icon fas fa-dollar-sign red"></i>
                                            <p>
                                                Modos de pagos
                                            </p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'ingresoProducto'}" class="nav-link">
                                            <i class="nav-icon fas fa-shopping-cart pink"></i>
                                            <p>
                                                Ingresos de productos
                                            </p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'producto'}" class="nav-link">
                                            <i class="nav-icon fas fa-box indigo"></i>
                                            <p>
                                                Productos
                                            </p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name : 'habitacion'}" class="nav-link">
                                            <i class="nav-icon fas fa-door-open orange"></i>
                                            <p>
                                                Habitaciones
                                            </p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            @endcan



                            <li class="nav-item">

                                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fas fa-power-off red"></i>
                                    <p>
                                        {{ __('Logout') }}
                                    </p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- content -->
            <div class="content-wrapper">
                <div class="container-fluid">
                    <vue-progress-bar></vue-progress-bar>
                    <transition name="component-fade" mode="out-in">
                        <router-view :key="$route.fullPath"></router-view>
                    </transition>
                    <app></app>
                </div>
            </div>
            <!-- /.content -->

        </div> <!-- /.body -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                ♣♠♥♦
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2020 <a href="https://adminlte.io">Sebastian Sangermano</a>.</strong> todos los derechos reservados.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="/js/app.js"></script>
</body>
</html>
