@extends('layouts.admin')
@section('formule')

<head>
    <title>Dossier </title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
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


        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
            /* Alternate row background color */
        }
    </style>
</head>

<body>
    <br>
    <br>
    <br>

    <div class="card">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif

        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif
        <div class="table-responsive" style="overflow-y: auto;">
            <br>

            <div class="btn-group ml-2">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="{{ url('/export_dossier') }}">
                    <button type="button" class="btn btn-dark ml-3" style="color: white">
                        <i class="fas fa-file-download"> </i>&nbsp; Export Excel
                    </button>
                </a>

            </div>


            <table class="table table-hover table-striped mt-2 mr-4" id="myTable">
                <thead>
                    <tr>
                        <th>N° Dum</th>
                        <th>N° Dossier</th>
                        <th>@sortablelink('created_at', 'Date Dossier') </th>
                        <th>Navire</th>
                        <th>Date d´arrivé</th>
                        <th>Expéditeur</th>
                        <th>@sortablelink('destinataire', 'Déstinataire') </th>
                        <th>Poids Brut</th>
                        <th>@sortablelink('poids_net', 'Poids Net')</th>
                        <th>@sortablelink('n_colis', 'Numéro de Colis')</th>
                        <th>Intitule Marchandises</th>

                        <th>Voir</th>
                        <th>Reaffecter</th>
                        <th>Annexer</th>
                        <th> DUM</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dossiers as $dossier)
                    <tr>

                        <td>
                            <a href="/voirDum/{{ $dossier->num_dum}}" class="nav-link">
                                <p> {{ $dossier->num_dum}}
                                </p>
                            </a>
                        </td>
                        <td>{{ $dossier->n_dossier}}</td>
                        <td>{{date(" d-m-Y", strtotime($dossier->created_at))}}</td>
                        <td>Navire</td>{{-- navire??? --}}
                        {{-- <td>{{$dossier->n_moyen}}</td> --}}
                        <td>{{date(" d-m-Y", strtotime($dossier->date_arrive))}}</td>
                        <td>{{ $dossier->expediteur}}</td>
                        <td>{{ $dossier->destinataire }}</td>
                        <td>{{ $dossier->poids_brut }}</td>
                        <td>{{ $dossier->poids_net }}</td>
                        <td>{{ $dossier->n_colis}}</td>
                        <td>{{ $dossier->designation_marchandise }}</td>
                        <td>
                            <form action="{{url('/dossier/voir')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id1" value="{{Crypt::encrypt($dossier->id) }}">
                                <button type="submit" class="btn "><i class="far fa-eye fa-beat"
                                        style="color: #ffc107 !important;"></i> </button>

                            </form>
                        </td>


                        <td class="text-center">
                            @livewire('affecter-button', ['idaze' => Crypt::encrypt($dossier->id)])
                        </td>
                        <td class="text-center">
                            <form action="{{ route('get.fileupload') }}" method="GET">
                                <input type="hidden" name="id" value="{{ Crypt::encrypt($dossier->id) }}">
                                <button type="submit" class="btn  "><i class="fas fa-folder-open"
                                        style="color: #06328f !important;"></i></button>
                            </form>
                        </td>
                        {{--<td>

                            @if(isset($dossier->poids_brut))
                            <button type="submit" class="btn btn-info mybtn">déclarer</button>
                            @else
                            <button type="submit" class="btn btn-danger">déclarer</button>
                            @endif
                        </td>--}}

                        <td>
                            <form action="{{url('/creer/dum')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id1" value="{{Crypt::encrypt($dossier->id) }}">
                                <button type="submit" class="btn "> <i class="fas fa-plus"
                                        style="color: #1d1d1c !important;"></i> </button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="javascript:history.go(-1)" class="btn btn-secondary">Go Back</a>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/style.js"></script>
    <script>
        $(document).ready(function() {
$('#myTable').DataTable({
"order": [[2, "desc"]]
});
});
    </script>

</body>
@endsection
