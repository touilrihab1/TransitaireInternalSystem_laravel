<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/png" id="favii con" href="dist/img/favicon.ico?v=2">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Transit in Time</title>
    <link rel="stylesheet"
        href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css')}}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
        rel="stylesheet')}}">
    <style>
        .nav-item.active>.nav-link {
            background-color: #92272cec !important;
            color: #fff;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">
    <div class="wrapper">
        <!-- Navbar -->

        </nav>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside style="background-color:#ffffff " class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <a style="background-color: #ffffff; display: flex; align-items: center; justify-content: center;"
                href="{{url('/clientHome')}}" class="brand-link">
                <img src="dist/img/transit.jpg" alt="transit" class="brand-image img-circle elevation-3 "
                    style="opacity: .9">

                <span class="brand-text mr-4" style="color: black;">Transit in Time</span>
            </a>



            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-2  mb-2 d-flex">
                    <div class="image">
                        <img src="{{ \Laravolt\Avatar\Facade::create(auth()->user()->name)
              ->setBackground('#000000')
              ->setForeground('#FFFFFF')
              ->toBase64() }}" class="img-circle elevation-1" style="background-color: black" alt="User Image">
                    </div>
                    <div class="info">
                        <strong> <a href="#" class="d-block" style="color: white">{{ auth()->user()->name
                                }}</a></strong>
                        <a href="#" class="d-block" style="color: white"> ( {{
                            auth()->user()->roles->pluck("name")->first() }} )</a>
                    </div>
                </div>







                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item {{ request()->is('statistique') ? 'active' : '' }}"> <a
                                href="{{url('/statistique')}}" class="nav-link">
                                <i class="fas fa-chart-bar nav-icon"></i>
                                <p><strong>Statistique</strong></p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('dossierClient') ? 'active' : '' }}">
                            <a href="{{url('/dossierClient')}}" class="nav-link">
                                <i class="fas fa-folder-open nav-icon"></i>
                                <p><strong>Vos Dossiers</strong></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                                <p>Logout</p>
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



        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper"
            style="margin-top: 1%; background-color: #f3f4f6 !important; width: 100vw !important;">
            @yield('formuleClient')
        </div>

    </div>


    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js')}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('dist/js/demo.js')}}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
    <script src="{{ asset('plugins/raphael/raphael.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
    <script src="{{ asset('plugins/jquery-mapael/maps/world_countries.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>

    <!-- PAGE SCRIPTS -->
    <script src="{{ asset('dist/js/pages/dashboard2.js')}}"></script>

</body>

</html>
