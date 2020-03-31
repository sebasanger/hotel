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
            <nav class="main-header navbar navbar-expand navbar-dark">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>

                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>

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
                                    <i class="nav-icon fas fa-tachometer-alt blue"></i>
                                    <p>
                                        Inicio
                                    </p>
                                </router-link>
                            </li>

                            <li class="nav-item">
                                <router-link to="/clientes" class="nav-link">
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
                                        <router-link to="/users" class="nav-link">
                                            <i class="far fa-circle nav-icon fas fa-user yellow"></i>
                                            <p>Usuarios</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link to="/facturas" class="nav-link">
                                            <i class="nav-icon fas fa-paperclip teal"></i>
                                            <p>
                                                Facturas
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
                        <router-view></router-view>
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



</body>
</html>
