@extends('layouts.admin')

@section('formule')
<!---------------------------------modifier id de table des articles---------------------->

<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <title>formulaire Dossier </title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #add {
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .container {
            width: 95% !important;
            max-width: 95% !important;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            /* Add padding to the card */
        }
    </style>
    @livewireStyles
</head>

<body>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="card">
            <div class="container ">
                <div class="card-header">Entête de Facture </div>
                <div class="form-row container">
                    <div class="form-row container">
                        <div class="form-group col ">
                            <label for="num_dum1">N° DUM</label>
                            <input type="text" class="form-control" id="num_dum1" disabled>
                        </div>
                        <div class="form-group col">
                            <label for="importeur">Importeur</label>
                            <input type="text" class="form-control" id="importeur" disabled>
                        </div>

                        <div class="form-group col ">
                            <label for="num_dossier1">N° Dossier</label>
                            <input type="text" class="form-control" id="num_dossier1"
                                value="{{ $dossier[0]->n_dossier }}" disabled>

                        </div>
                        <div class="form-group col ">
                            <label for="date_dossier1">Date de Dossier</label>
                            <input type="text" class="form-control" id="date_dossier1" value="{{date(" d-m-Y",
                                strtotime($dossier[0]->date_dedouanement))}}"disabled>
                        </div>


                        <div class="form-row container">
                            <div class="form-group col ">
                                <label for="expediteur">Expéditeur</label>
                                <input type="text" class="form-control" id="expediteur"
                                    value="{{$dossier[0]->expediteur}}" disabled>
                            </div>
                            <div class="form-group col">
                                <label for="nom_producteur">Nom producteur</label>
                                <input type="text" class="form-control" id="nom_producteur" disabled>
                            </div>
                            <div class="form-group col ">
                                <label for="num_station">N° Station</label>
                                <input type="text" class="form-control" id="num_station" disabled>
                            </div>
                            <div class="form-group col ">
                                <label for="tel1">Tel</label>
                                <input type="text" class="form-control" id="tel1" disabled>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    @livewire('facture-modifier-component', ['id1' => $id1 , 'dossier' => $dossier ,'factures'=>$facture
                    ,
                    'articles'=>$articles])
                </div>

            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="js/style.js"></script>
        @livewireScripts
        <div>
            <div>
</body>

</html>
@endsection
