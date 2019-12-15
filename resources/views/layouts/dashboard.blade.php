<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{ asset('img/logo/book-icon.jpg') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <!-- Vue -->
    
<script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Los clubes de lectura</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <!-- CSS Files -->
    <link href="{{ asset('css/material-dashboard.min.css') }}" rel="stylesheet" />

    <!-- FULL CALENDAR -->

    <link href="{{ asset('css/plugins/fullcalendar/main.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/fullcalendar/daygrid.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <style>
        /*Top navbar hover color*/
        .dropdown-item:hover {
            background-color: #8B8378 !important;
        }

        .dropdown-item:focus {
            background-color: #8B8378 !important;
        }

        .dropdown-item:active {
            background-color: #8B8378 !important;
        }
    </style>

</head>
<div id="app">
    <div class="wrapper ">
        <div class="sidebar" data-color="azure" data-background-color="black" style="background-image:url('/img/dashboard/sidebar-2.jpg')">
            <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
            <div class="logo">
                <a href="/home" class="simple-text logo-mini">
                    CL
                </a>
                <a href="/home" class="simple-text logo-normal">
                    Clubes de lectura
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">
                            <i class="material-icons">dashboard</i>
                            <p> Inicio </p>
                        </a>
                    </li>
                    <li class="nav-item ">

                        <b-link class="nav-link" v-b-toggle.d-1>
                            <i class="material-icons">book</i>
                            <p> Clubes de lectura
                                <b class="caret"></b>
                            </p>
                        </b-link>
                        <b-collapse class="collapse" id="d-1">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="/browseclubs">
                                        <span class="sidebar-normal"> Gestión de clubes </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/selectclub">
                                        <span class="sidebar-normal"> Gestión de miembros </span>
                                    </a>
                                </li>
                            </ul>
                        </b-collapse>
                    </li>
                    <li class="nav-item ">
                        <b-link class="nav-link" v-b-toggle.d-2>
                            <i class="material-icons">group</i>
                            <p> Grupos de lectura
                                <b class="caret"></b>
                            </p>
                        </b-link>

                        <b-collapse class="collapse" id="d-2">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="/selectclubg">
                                        <span class="sidebar-normal"> Gestión de grupos </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/selectclubgm">
                                        <span class="sidebar-normal"> Gestión de miembros</span>
                                    </a>
                                </li>
                            </ul>
                        </b-collapse>
                    </li>
                    <li class="nav-item ">
                        <b-link class="nav-link" v-b-toggle.d-3>
                            <i class="material-icons">calendar_today</i>
                            <p> Reuniones
                                <b class="caret"></b>
                            </p>
                        </b-link>
                        <b-collapse id="d-3" class="collapse">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="/selectclubr">
                                        <span class="sidebar-normal"> Gestión de reuniones </span>
                                    </a>
                                </li>
                            </ul>
                        </b-collapse>
                    </li>
                    <li class="nav-item ">
                        <b-link class="nav-link" v-b-toggle.d-4>
                            <i class="material-icons">menu_book</i>
                            <p> Libros
                                <b class="caret"></b>
                            </p>
                        </b-link>
                        <b-collapse id="d-4" class="collapse">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="/books">
                                        <span class="sidebar-normal"> Gestión de libros </span>
                                    </a>
                                </li>
                            </ul>
                        </b-collapse>
                    </li>
                    <li class="nav-item ">
                        <b-link class="nav-link" v-b-toggle.d-5>
                            <i class="material-icons">camera_roll</i>
                            <p> Obras de teatro
                                <b class="caret"></b>
                            </p>
                        </b-link>

                        <b-collapse id="d-5" class="collapse">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="/playsclubs">
                                        <span class="sidebar-normal"> Obras actuadas por club </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/earningplays">
                                        <span class="sidebar-normal"> Ganancias por obra </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/browseplays">
                                        <span class="sidebar-normal"> Explorar obras de teatro </span>
                                    </a>
                                </li>
                            </ul>
                        </b-collapse>

                    <li class="nav-item ">
                        <b-link class="nav-link" v-b-toggle.d-6>
                            <i class="material-icons">file_copy</i>
                            <p> Reportes
                                <b class="caret"></b>
                            </p>
                        </b-link>

                        <b-collapse id="d-6" class="collapse">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="/members">
                                        <span class="sidebar-normal"> Club </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="/clubreports">
                                        <span class="sidebar-normal"> Miembros de club </span>
                                    </a>
                                </li>
                            </ul>
                        </b-collapse>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <b-navbar toggleable="lg" class="navbar-expand-lg navbar-transparent">

                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                <b-collapse id="nav-collapse" is-nav>

                    <!-- Right aligned nav items -->
                    <b-navbar-nav class="ml-auto">

                        <b-nav-item-dropdown text="{{ Auth::user()->name }}" right>
                            <b-dropdown-item href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </b-dropdown-item>
                        </b-nav-item-dropdown>
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>

            <div class="dashboard-content">
                <div class="container">
                    @yield('content')
                </div>
            </div>

        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script type="application/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/popper.min.js') }}"></script>

<script type="application/javascript" src="{{ asset('js/bootstrap-material-design.min.js') }}" defer></script>
<!-- Plugin for the momentJs  -->
<script type="application/javascript" src="{{ asset('js/plugins/moment.min.js') }}" defer></script>
<!-- Forms Validations Plugin -->
<script type="application/javascript" src="{{ asset('js/plugins/jquery.validate.min.js') }}" defer></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
<script type="application/javascript" src="{{ asset('js/plugins/jquery.bootstrap-wizard.js') }}" defer></script>
<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script type="application/javascript" src="{{ asset('js/plugins/bootstrap-datetimepicker.min.js') }}" defer></script>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script type="application/javascript" src="{{ asset('js/plugins/jquery.dataTables.min.js') }}" defer></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script type="application/javascript" src="{{ asset('js/plugins/bootstrap-tagsinput.js') }}" defer></script>
<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
<script type="application/javascript" src="{{ asset('js/plugins/jasny-bootstrap.min.js') }}" defer></script>

<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script type="application/javascript" src="{{ asset('js/plugins/nouislider.min.js') }}" defer></script>
<!-- Library for adding dinamically elements -->
<script type="application/javascript" src="{{ asset('js/plugins/arrive.min.js') }}" defer></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script type="application/javascript" src="{{ asset('js/plugins/buttons.js') }}" defer></script>
<!-- Chartist JS -->
<script type="application/javascript" src="{{ asset('js/plugins/chartist.min.js') }}" defer></script>

<!-- FULL CALENDAR -->
<script type="application/javascript" src="{{ asset('js/plugins/fullcalendar/main.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/plugins/fullcalendar/daygrid.min.js') }}"></script>

<script type="application/javascript">
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

</body>

</html>