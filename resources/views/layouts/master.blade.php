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
    component-fade-enter-active,
    .component-fade-leave-active {
        transition: opacity .3s ease;
    }

    .component-fade-enter,
    .component-fade-leave-to

    /* .component-fade-leave-active below version 2.1.8 */
        {
        opacity: 0;
    }

</style>

<body class="hold-transition sidebar-mini">
    <div id="app">

        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-dark mb-2">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <cambio></cambio>
                </ul>



            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <router-link to="/" class="brand-link">
                    <img src="./img/hl.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Hotel</span>
                </router-link>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="./img/perro.jpg" class="img-circle elevation-2" alt="User Image">
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
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

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
            <strong>Copyright &copy; 2020 <a href="https://adminlte.io">Sebastian sangermnao</a>.</strong> todos los derechos reservados.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gantt-schedule-timeline-calendar"></script>


</body>
</html>
