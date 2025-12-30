@extends('layouts.admin')
@section('formule')
<title>Dossier </title>

<head>
    @livewireStyles
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-Vo8e87N62w+47gFS94axDfn7Kp3zyX21/ACiC4ScJC5nvqjCB2TKD5vHvepSScI0" crossorigin="anonymous">

    <link rel="stylesheet" href="css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
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
            <br>
         
            <div class="page-header">
                <h1 class="page-title">Les factures Mensuelle</h1>
            </div>
            <br>
            <div class="card">
         <div class="card-header">
                <button class="btn add-button" data-toggle="modal" data-target="#factureModal">
                    <i class="fas fa-plus"></i> Ajouter facture
                </button>
            </div>
          
            <table class="table table-hover ">
                <thead>
                    <tr>
                        <th>N° Facture</th>
                        <th>Date Facture</th>
                        <th>Client</th>
                        <th>Net à payer</th>
                        <th>Etat</th>
                        <th>Annexer</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($factures as $facture)
                    <tr>

                        <td class="text-center">
                            {{$facture->num_facture}}
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

            </div>
            <br>
            <br>
            <br>
            <br><br><br><br><br><br> <br><br><br><br> <br><br><br><br><br>

        </div>
    </div>
    <div id="modals">
        <?php
                use App\Models\devise;
                     $devise = devise::all();
                 ?>

        <div class="modal fade" id="factureModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="form-group col-md ">
                        <h5 class="modal-title">creer facture :</h5>
                    </div>
                    </div>
                        <div class="modal-body">

                        <form action='/ajouter/factureFinalMensuelle' method="POST">
                            @csrf
                            <div class="form-group">
                            <input type="text" name="codeTiers" placeholder="entrer Code Tiers">

                            </div>
                            <div class="form-group">

                            <select name="type" class="custom-select" id="type" required>
                                <option value="" selected disabled>Select Devise</option>
                                @foreach($devises as $key => $type)
                                <option value="{{ $type->Id_Devise }}">{{ $type->Code_Devise }}</option>
                                @endforeach
                            </select>
                            </div> 
                            <div class="form-group">
                            <select id="moisSelect" name="mois">
                                <option value="1">Janvier</option>
                                <option value="2">Février</option>
                                <option value="3">Mars</option>
                                <option value="4">Avril</option>
                                <option value="5">Mai</option>
                                <option value="6">Juin</option>
                                <option value="7">Juillet</option>
                                <option value="8">Août</option>
                                <option value="9">Septembre</option>
                                <option value="10">Octobre</option>
                                <option value="11">Novembre</option>
                                <option value="12">Décembre</option>
                            </select>

                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                            <input type="submit" class="btn btn-success mybtn">
                            </div>
                        </form>

                    </div>
                    </div>
                </div>
            </div>

        </div>

        <br>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>


    @livewireScripts

</body>
@endsection