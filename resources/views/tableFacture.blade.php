@extends('layouts.admin')

@section('formule')
<title>Dossier</title>

<head>
    @livewireStyles
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-Vo8e87N62w+47gFS94axDfn7Kp3zyX21/ACiC4ScJC5nvqjCB2TKD5vHvepSScI0" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    {{-- @if(Session::has('download.in.the.next.request'))
         <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
      @endif --}}
   <style>
        /* Custom Styles */
        body {
            background-color: #f8f9fa;
        }

        .container {
            width: 95% !important;
            max-width: 100% !important;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            /* Add padding to the card */
        }

        .page-header {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .add-button {
            background-color: #343a40;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            margin-bottom: 20px;
        }

        .add-button:hover {
            background-color: #23272b;
            color: #fff;
        }

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

        .table-container {
            max-width: 90%;
            overflow-x: auto;
        }

        table {
            border-collapse: collapse;
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
            font-weight: bold;
        }

        tbody tr:nth-child(even) {
            background-color: #f8f9fa;
            /* Alternate row background color */
        }

        /* Additional styles for the modal */
        #factureModal .modal-dialog {
            max-width: 500px;
        }

        #factureModal .form-group {
            margin-bottom: 20px;
        }

        #factureModal .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <br>
            <br>
            <div class="page-header">
                <h1 class="page-title">Les factures</h1>
            </div>
            <div class="container mt-4">
                @if ($message = Session::get('success'))
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <p class="mb-0">{{ $message }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <button class="btn add-button" data-toggle="modal" data-target="#factureModal">
                            <i class="fas fa-plus"></i> Ajouter facture
                        </button>
                    </div>



                    <table class="table table-hover">

                        <thead>
                            <tr>
                                <th>N° Facture</th>
                                <th>N° Dossier</th>
                                <th>Date Facture</th>
                                <th>client</th>
                                <th>net à payer</th>
                                <th>état</th>
                                <th>annexer</th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($factures as $facture)
                            <tr>

                                <td class="text-center">
                                    {{$facture->num_facture}}
                                </td>
                                <td class="text-center">
                                    {{$facture->n_dossier}}
                                </td>

                                <td class="text-center">
                                    {{date(" d-m-Y",
                                    strtotime($facture->created_at))}}

                                </td>
                                <td class="text-center">
                                    {{$facture->Raison_Sociale}}
                                </td>
                                <td class="text-center">
                                    {{$facture->valeur_net}}
                                </td>
                                <td class="text-center">
                                    {{$facture->etat}}
                                </td>

                                <td class="text-center">

                                    <form action="{{ route('get.fileupload') }}" method="GET">
                                        <input type="hidden" name="id" value="{{ Crypt::encrypt($facture->id) }}">

                                        <button type="submit" class="btn btn-warning "><i
                                                class="fas fa-folder-open"></i></button>
                                    </form>


                                </td>

                            </tr>

                            @endforeach
                        </tbody>
                    </table>

                </div>
                <br>
                <br>
                <br>
                <br><br><br><br><br><br> <br><br><br><br>
            </div>
        </div>
    </div>

    <div id="modals">
        <?php
            use App\Models\devise;
            $devise = devise::all();
        ?>
        <div class="modal fade" id="factureModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Créer facture :</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/ajouter/factureFinal" method="POST" id="form1">
                            @csrf
                            <div class="form-group">
                                <label for="num_dossier" class="form-label">Numéro de dossier :</label>
                                <input type="text" name="num_dossier" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="type" class="form-label">Sélectionner la devise :</label>
                                <select name="type" class="custom-select" id="type" required>
                                    <option value="" selected disabled>Select Devise</option>
                                    @foreach($devises as $key => $type)
                                    <option value="{{ $type->Id_Devise }}">{{ $type->Code_Devise }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Annuler</button>
                               
                                <button type="submit" class="btn btn-success" >Créer</button>
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <script>
window.addEventListener('focus', function(){
console.log('mm');
});

       
 



    </script>

    @livewireScripts
</body>

@endsection
