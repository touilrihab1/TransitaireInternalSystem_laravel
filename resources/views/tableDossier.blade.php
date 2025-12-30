@extends('layouts.admin')
@section('formule')
<title>Dossier </title>

<head>
    @livewireStyles
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-Vo8e87N62w+47gFS94axDfn7Kp3zyX21/ACiC4ScJC5nvqjCB2TKD5vHvepSScI0" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        table {
            /* Remove the width property to allow the table to adjust automatically */
            /* width: 100%; */
            border-collapse: collapse;
        }

        /* Add a container div to make the table scroll horizontally if necessary */
        .table-container {
            max-width: 90%;
            overflow-x: auto;
        }

        .table-responsive {
            padding: 10px 0;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            vertical-align: top;
            white-space: nowrap;
            border: rgb(196, 191, 191) 1px solid;
        }

        thead {
            /* background-color: #ddd; */
            font-weight: bold;
        }

        .mybtn {
            background-color: #437bb8;
            color: #fff;
            border-radius: 5px;
            border: none;
            padding: 5px 10px;
        }

        input .form-control:hover {}

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            /* Add padding to the card */
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            font-weight: bold;
            padding-bottom: 10px;
            /* Add padding to the card header */
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
            /* Alternate row background color */
        }
    </style>
</head>

<body>


    <div class="card">

        <br>
        <br>
        <div class="d-flex align-items-center justify-content-end mr-3">
            <div class="btn-group ml-2">

                <a href="{{ url('/export_dossier') }}">
                    <button type="button" class="btn btn-dark ml-3" style="color: white">
                        <i class="fas fa-file-download"> </i>&nbsp; Export Excel
                    </button>
                </a>
                <a href="{{ url('/formulaire') }}">
                    <button type="button" class="btn btn-secondary ml-3" style="color: white">
                        <i class="fas fa-user-plus"> </i>Ajouter dossier
                    </button>
                </a>
            </div>

            <form action="{{ route('dossier.search') }}" method="GET" class="search-form flex-grow-1"
                style="color: black !!important;">
                <style>
                    a {
                        color: black !important;
                    }
                </style>
                <div class="input-group ml-4">
                    <input type="text" name="query" class="form-control col-md-3" placeholder="Recherche..."
                        style="background-color: white;">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>


            <form action="{{ route('dossier.filter') }}" method="GET" class="ml-6">
                <div class="form-group mb-0">
                    <div class="input-group">
                        <select class="form-control" id="type_dossier" name="type_dossier">
                            <option value="">Tous</option>
                            <option value="import">Import</option>
                            <option value="export">Export</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-dark"><i class="fas fa-filter"></i></button>
                        </div>
                    </div>
                </div>
            </form>

        </div>





        <br>
        <div class="t " style="width: 100% !important;">
            @if ($message = Session::get('success'))
            <div class="alert alert-dark alert-dismissible fade show my-2 ml-5" role="alert"
                style="height: auto; max-height: 80px; width:100%">
                <p class="mb-0">{{ $message }}</p>
            </div>

            <style>
                .alert {
                    padding: 0.5rem 1rem;
                    font-size: 14px;
                }
            </style>

            <script>
                // Auto-dismiss the success message after 5 seconds
                                    setTimeout(function() {
                                        $(".alert").alert('close');
                                    }, 5000);
            </script>
            @endif
            <table id="myTable" class="table table-hover mt-2 ml-3 table-container table-striped"
                style="width: 100% !important;">

                <thead>
                    <tr>

                        <th>@sortablelink('num_dum', 'N° Dum') </th>
                        <th>@sortablelink('n_dossier', 'N° Dossier') </th>
                        <th>@sortablelink('created_at', 'Date Dossier') </th>
                        <th>@sortablelink('navire', 'Navire') </th>
                        <th>@sortablelink('matricule', 'Matricule') </th>
                        <th>@sortablelink('date_arrive', 'Date d´arrivé') </th>
                        <th>@sortablelink('expediteur', 'Expéditeur') </th>
                        <th>@sortablelink('destinataire', 'Déstinataire') </th>
                        <th>@sortablelink('poids_brut', 'Poids Brut') </th>
                        <th>@sortablelink('poids_net', 'Poids Net') </th>
                        <th>@sortablelink('n_colis', 'Nombre colis') </th>
                        <th>@sortablelink('designation_marchandise', 'Intitule Marchandises') </th>

                        <th>Etat</th>
                        <th>voir</th>
                        @if (auth()->user()->hasPermissionTo('annexer document'))
                        <th>annexer</th>
                        @endif
                        <th>affecter</th>
                        <th>modifier</th>
                    </tr>
                </thead>
                <tbody>
                    @if($dossiers->count())
                    @foreach ($dossiers as $dossier)
                    <tr>

                        <td>{{ $dossier->num_dum }}</td>
                        <td>{{ $dossier->n_dossier }}</td>
                        <td>{{date(" d-m-Y", strtotime($dossier->created_at))}}</td>{{-- date dossier??? --}}
                        <td>navire</td>{{-- navire??? --}}
                        <td>{{ $dossier->n_moyen }}</td>{{-- Matricule??? --}}
                        <td>{{date(" d-m-Y", strtotime($dossier->date_arrive))}}</td>
                        <td>{{ $dossier->expediteur }}</td>
                        <td>{{ $dossier->destinataire }}</td>
                        <td>{{ $dossier->poids_brut }}</td>
                        <td>{{ $dossier->poids_net }}</td>
                        <td>{{ $dossier->n_colis }}</td>
                        <td>{{ $dossier->designation_marchandise }}</td>

                        <td>{{$dossier->Libelle_Sous_Statut}}</td>
                        <td class="text-center">
                            <form action="{{ url('/dossier/voir') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id1" value="{{ Crypt::encrypt($dossier->id) }}">
                                <button type="submit" class="btn btn-success "><i class="far fa-eye"></i></button>
                            </form>
                        </td>

                        @if (auth()->user()->hasPermissionTo('annexer document'))

                        <td class="text-center">
                            <?php
                            if($dossier->Libelle_Sous_Statut != 'Affecter Dédouanement' && $dossier->Libelle_Sous_Statut != 'Dossier Complet')
                            {
                            ?>
                            <form action="{{ route('get.fileupload') }}" method="GET">
                                <input type="hidden" name="id" value="{{ Crypt::encrypt($dossier->id) }}">

                                <button type="submit" class="btn btn-warning "><i
                                        class="fas fa-folder-open"></i></button>
                            </form>
                            <?php }
                             else {?>
                            <button type="submit" class="btn btn-warning "><i class="fas fa-folder-open"></i></button>
                            <?php }?>
                        </td>
                        @endif

                        <td class="text-center">
                            @livewire('affecter-button', ['idaze' => Crypt::encrypt($dossier->id)])
                        </td>

                        <td class="text-center">

                            <?php
                            if($dossier->Libelle_Sous_Statut != 'Affecter Dédouanement' && $dossier->Libelle_Sous_Statut != 'Dossier Complet')
                            {
                            ?>
                            <form action="{{ url('/dossier/modifier') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ Crypt::encrypt($dossier->id) }}">
                                <button type="submit" class="btn btn-primary "><i class="far fa-edit"></i></button>
                            </form>
                            <?php }
                                else {?>
                            <button type="submit" class="btn btn-primary "><i class="far fa-edit"></i></button>
                            <?php }?>
                        </td>

                    </tr>
                    @endforeach
                    @endif


                </tbody>
            </table>

            {{-- {!! $dossiers->appends(\Request::except('page'))->render() !!} --}}

        </div>

        <br>
        <br>
        <br>
        <br><br><br><br><br><br> <br><br><br><br> <br><br><br>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>

    <script>
        $(document).ready(function() {
        $('#myTable').DataTable();
    });
    </script>

    @livewireScripts

</body>
@endsection
