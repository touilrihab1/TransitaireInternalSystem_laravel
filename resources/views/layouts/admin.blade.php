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
        @import url(https://fonts.googleapis.com/css?family=Muli);

        * {
            transition: all 0.5s;
            -webkit-transition: all 0.5s;
        }

        .toggle {

            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .btn-show {
            display: flex;
            align-items: right;
            justify-content: right;
        }

        .toggle i {
            color: #212529;
            font-size: 20px;
        }


        .fa {
            margin-left: 7px;
            margin-top: -4px;
        }

        .toggle:hover {
            -ms-transform: rotate(360deg);
            /* IE 9 */
            -webkit-transform: rotate(360deg);
            /* Safari */
            transform: rotate(360deg);
        }

        .sidebar1 {

            position: absolute;
            right: 0;
            top: 0;
            width: 300px;
            height: 100vh;
            background-color: #f8f9fa;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            z-index: 999;
            display: none;
        }

        .sidebar1.active {
            display: block;
        }

        .sidebar1 h3 {
            text-align: center;
            color: #212529;
            margin-bottom: 20px;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        .notibox {
            background-color: #ffffff;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }

        .notibox .cancel {
            cursor: pointer;

            position: fixed;
            width: 300px;
            right: -500px;
            box-shadow: 0px 0px 10px 3px black;
            background-color: #1a1a1a;
            border-left: 1px solid black;
            height: 100%;
            top: 0px;
        }



        .nav-treeview .nav-item.active>.nav-link {
            background-color: #e2dcdce1 !important;
            color: #fff;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed ">
    <div class="wrapper">
        <!-- Navbar -->
        <?php  use App\Models\Dossier;?>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!--------------------change ----------------->

            <div class="ml-auto d-flex align-items-center">
                <div class="toggle mr-3">
                    <i class="fa fa-bell"></i>
                </div>
                @if(auth()->user()->hasPermissionTo('taux de change'))
                <div>
                    <button class="btn btn-link btn-show" data-toggle="modal" data-target="#userModal">
                        <i class="fas fa-money-bill-wave" style="color: #1a1a1a !important;"></i>
                    </button>
                </div>
                @endif
            </div>
            <?php if(auth()->user()->hasRole('exploitation')){ ?>

            <div class="sidebar1">

                <h3> Notifications</h3>

                <hr>
                <?php
    $dossiers = Dossier::leftJoin('dum_dossier', 'dossiers.id', '=', 'dum_dossier.id_dossier')
        ->leftJoin('dums', 'dum_dossier.id_dum', '=', 'dums.id')
        ->join('affectation', 'dossiers.id', '=', 'affectation.id_dossier')
        ->select('dossiers.*', 'dums.num_dum', 'affectation.observation')
        ->where('affectation.id_role', '=', '2')
        ->get();
    ?>
                <?php foreach ($dossiers as $dossier) { ?>
                <div class="notibox">
                    {{$dossier->n_dossier}} - {{$dossier->observation}}
                    <div class="cancel" onclick="deleteNotification(this)"><i class="fas fa-times"></i>

                    </div>
                    <?php } ?>
                </div>
                <?php }?>
            </div>
            <?php  if(auth()->user()->hasRole('dédouanement')){ ?>

            <div class="sidebar1">

                <h3>Notifications</h3>
                <hr>

                <?php

                  $dossiers= Dossier::leftJoin('dum_dossier', 'dossiers.id', '=', 'dum_dossier.id_dossier')
                  ->leftJoin('dums', 'dum_dossier.id_dum', '=', 'dums.id')
                  ->join('affectation', 'dossiers.id', '=', 'affectation.id_dossier')
                  ->select('dossiers.*', 'dums.num_dum' , 'affectation.observation')
                  ->where('affectation.id_role', '=', '3')
                  ->get();
                  ?>
                <?php
                 foreach ($dossiers as $dossier) {  ?>
                <div class="notibox">
                    {{$dossier->n_dossier}} - {{$dossier->observation}}

                    <div class="cancel" onclick="deleteNotification(this)"><i class="fas fa-times"></i>
                    </div>

                </div>


                <?php   } ?>
            </div>
            <?php }?>
        </nav>

        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside style="background-color:#ffffff " class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->

            <a style="background-color: #ffffff; display: flex; align-items: center; justify-content: center;"
                href="{{url('/home')}}" class="brand-link">
                {{-- <img src="dist/img/transit.jpg" alt="transit" class="brand-image img-circle elevation-6"
                    style="opacity: .9"> --}}
                <span class="brand-text" style="color: black;">Transit in Time</span>
            </a>



            <!-- Sidebar -->
           



            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
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
                        @if (auth()->user()->hasRole('Admin'))

                        <li class="nav-item has-treeview ">
                            <a class="nav-link" href="#" style="background-color: #92272cec !important;">
                                <i class="fas fa-cogs"></i>&nbsp;&nbsp;
                                <p><strong>Management</strong> </p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.index') }}">
                                        <i class="fas fa-angle-right"></i>
                                        <p>Gestion des utilisateurs</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('roles.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('roles.index') }}">
                                        <i class="fas fa-angle-right"></i>
                                        <p>Gestion des rôles</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('clients.index') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('clients.index') }}">
                                        <i class="fas fa-angle-right"></i>
                                        <p>Gestion des clients</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        @endif
                        @if (auth()->user()->hasRole('dédouanement')|| auth()->user()->hasRole('exploitation') )
                        <li class="nav-item has-treeview " style="">
                            <a href="#" class="nav-link  " style="background-color:#961d23ec
            !important;">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p><strong>Traitement Dossier</strong>


                                </p><i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">

                                @if (auth()->user()->hasRole('exploitation'))
                                <li class="nav-item {{ request()->is('formulaire') ? 'active' : '' }}">
                                    <a href="{{ url('/formulaire') }}" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <p>Nouveau Dossier</p>
                                    </a>
                                </li>

                                @endif


                                @if (auth()->user()->hasRole('Admin'))
                                <li class="nav-item">
                                    <a href="{{ url('/traceOper') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                    </a>
                                </li>
                                <p>trace</p>
                                @endif

                            </ul>
                        </li>
                        @endif
                        @if (auth()->user()->hasRole('Admin'))
                        <li class="nav-item has-treeview">
                            <a href="{{ url('/traceOper') }}" class="nav-link">
                                <i class="fas fa-clock"></i>
                                <p>Traçabilité</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/addClient') }}" class="nav-link">
                                <i class="fas fa-user"></i>
                                <p>Ajouter Client</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                        </li>
                        @endif

                        @if (auth()->user()->hasRole('facturation'))
                        <li class="nav-item has-treeview">
                            <a class="nav-link" style="background-color:#961d23ec
                                                                                    !important;">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Facturation
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item {{ request()->routeIs('tableFacture') ? 'active' : '' }}">
                                    <a href="{{ url('/tableFacture') }}" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>liste facture</p>
                                    </a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('tableFactureMens') ? 'active' : '' }}">
                                    <a href="{{ url('/tableFactureMens') }}" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>liste facture
                                            mensuelle</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endif
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Tables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                @if (auth()->user()->hasRole('dédouanement'))
                                <li class="nav-item {{ request()->is('tableDossierDed') ? 'active' : '' }}"> <a
                                        href="{{ url('/tableDossierDed') }}" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>Dossier</p>
                                    </a>
                                </li>
                                @endif
                                @if (auth()->user()->hasRole('exploitation'))
                                <li class="nav-item {{ request()->is('tableDossier') ? 'active' : '' }}"> <a
                                        href="{{ url('/tableDossier') }}" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>Dossier</p>
                                    </a>
                                </li>
                                @endif
                                @if (auth()->user()->hasRole('facturation'))
                                <li class="nav-item {{ request()->is('tableDossier') ? 'active' : '' }}"> <a
                                        href="{{ url('/tableDossier') }}" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>Dossier</p>
                                    </a>
                                </li>
                                @endif

                               
                        
                   
     
                    </ul>
                    </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Structure
                                    <i class="fas fa-angle-left right"></i>
                                    {{-- <span class="badge badge-info right">6</span> --}}
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/tableBureau" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p> Bureau Douanier
                                        </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/allClient" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p> Client
                                        </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/tableArrond" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p> Bureau
                                            Arrondissement</p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/uniteMesure" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>Unité Mesure
                                        </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/origin" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>Les Origines
                                        </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('documents.nomenclature.index') }}" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>Nomenclature
                                        </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/article" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>Articles
                                        </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/devise" class="nav-link">
                                        <i class="fas fa-angle-right"></i>&nbsp;&nbsp;&nbsp;&nbsp; <p>Devise
                                        </p>
                                    </a>
                                </li>

                            </ul>
                        </li>




                        <li class="nav-item mt-5">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
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
        <!--------------------Modal change --------------------------------------->
        <div id="modals">
            <?php
    use App\Models\devise;
    $devise = devise::all();
    ?>

            <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Select Devise</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action='/save/devise' method="POST">
                                @csrf
                                <style>
                                    a {
                                        color: #1a1a1a !important;
                                    }
                                </style>
                                <div class="form-group">
                                    <label for="Devise" class="form-label">Devise:</label>
                                    <select class="form-control" id="Devise" name="devise">
                                        @foreach ($devise as $dv)
                                        <option value="{{ $dv->Code_Devise }}">{{ $dv->Intitule_Devise }} ({{
                                            $dv->Code_Devise
                                            }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="valeurChange" class="form-label">Value:</label>
                                    <input type="text" name="valeurChange" class="form-control"
                                        placeholder="Enter Value">
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper"
            style="margin-top: 1%; background-color: #f3f4f6 !important; width: 100vw !important;">
            @yield('formule')
        </div>

    </div>
    <!-- ./wrapper -->
    <script>
        var toggleButton = document.querySelector('.toggle');
    var sidebar = document.querySelector('.sidebar1');

    toggleButton.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        var isClickInsideSidebar = sidebar.contains(event.target);
        var isClickInsideToggleButton = toggleButton.contains(event.target);

        if (!isClickInsideSidebar && !isClickInsideToggleButton) {
            sidebar.classList.remove('active');

        }
    });
    </script>
    {{-- <script>
        function deleteNotification(button) {
        var notification = button.parentNode;
        notification.remove();
    }
    </script>--}}

    {{-- <script>
        $(".toggle").click(function () {
        console.log("toggling sidebar1");
          $(".sidebar1").toggleClass('active');

      });
      $(".cancel").click(function () {
        console.log("toggling visibility");
          $(this).parent().toggleClass('gone');

      });

    $(".cancel").click(function () {
    console.log("toggling visibility");
    var dossierId = $(this).parent().data('dossier-id');

    // Envoi de la requête AJAX
    $.ajax({
        url: '/dossier/' + dossierId + '/cancel',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function () {
            console.log("Requête AJAX envoyée avec succès");
            // Masquer la notification
            $(this).parent().toggleClass('gone');
        },
        error: function () {
            console.log("Erreur lors de l'envoi de la requête AJAX");
        }
    });
  });


    </script>--}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Fonction pour afficher le modal
        function showModal() {
            $('#userModal').modal('show');
        }

        // Fonction pour vérifier l'heure et afficher le modal si nécessaire
        function checkAndShowModal() {
            // Vérifier si l'heure est 22:50 et si le modal n'a pas été déjà affiché dans la session en cours
            if (isTimeToDisplayModal() && !hasModalBeenShown()) {
                showModal();

                // Enregistrer l'état d'affichage du modal dans la session en cours
                setModalShown();
            }
        }

        // Fonction pour vérifier si c'est l'heure d'afficher le modal (22:50)
        function isTimeToDisplayModal() {
            var currentDate = new Date();
            var currentHour = currentDate.getHours();
            var currentMinute = currentDate.getMinutes();


            return (currentHour === 00 && currentMinute === 00);

        }

        // Fonction pour vérifier si le modal a déjà été affiché dans la session en cours
        function hasModalBeenShown() {
            return sessionStorage.getItem('modalShown') === 'true';
        }

        // Fonction pour enregistrer l'état d'affichage du modal dans la session en cours
        function setModalShown() {
            sessionStorage.setItem('modalShown', 'true');
        }

        // Vérifier si le modal a été affiché en utilisant les cookies
        if (getCookie('modalShown') === 'true') {
            // Supprimer le cookie pour arrêter l'affichage du modal après actualisation
            document.cookie = 'modalShown=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        } else {
            // Appeler la fonction lors du chargement de la page
            document.addEventListener('DOMContentLoaded', function() {
                checkAndShowModal();
            });
        }

        // Fonction pour obtenir la valeur d'un cookie
        function getCookie(name) {
            var nameEQ = name + '=';
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') {
                    c = c.substring(1, c.length);
                }
                if (c.indexOf(nameEQ) === 0) {
                    return c.substring(nameEQ.length, c.length);
                }
            }
            return null;
        }
    </script>



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
