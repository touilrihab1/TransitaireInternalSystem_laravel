@extends('layouts.admin')

@section('formule')

<head>
    @livewireStyles
    <title>Formulaire Dossier</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
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

        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            font-weight: bold;
            padding-bottom: 10px;
            /* Add padding to the card header */
        }

        .btn-success {
            background-color: #08631d;
            color: white;
        }

        .mybtn {
            margin-top: 1px;
            float: right;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #5c5c59;
            padding: 3px 7px;
            line-height: normal;
            background-color: transparent;
            box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;
        }

        a {
            color: black !important;
        }

        .form-group {
            position: relative;
            margin-bottom: 15px;
            /* Increase the bottom margin */
        }

        .form-group .form-label {
            font-size: 14px;
        }

        .form-check-input[type="checkbox"],
        .form-check-input[type="radio"] {
            width: 20px;
            height: 20px;
            margin-top: 5px;
        }
    </style>
</head>

<body>


    <div class="container">
        <div class="card">
            <br>
            <div class="card-header">
                Détail du dossier
            </div>
            <div class="card-body">
                <form action='/ajouter/dossier' method="POST">
                    @csrf

                    <!-- Rest of the form code -->

                    <div class="form-group col-md-4">
                        {{-- <label for="Num_dum">N° DUM</label> --}}
                        <input type="text" class="form-control" id="Num_dum" name="num_dum" value="1" hidden>
                    </div>
                    {{--
                    <div class="form-group container">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Dossier_definitive"
                                name="dossier_definitive" value="false">
                            <label class="form-check-label" for="Dossier_definitive">Dossier Définitive</label>
                        </div>
                    </div> --}}

                    <div class="row container text-center">
                        <div class="col">
                            <input class="form-check-input" type="radio" name="type" id="Import" value="import" checked>
                            <label class="form-check-label" for="Import"> &nbsp;
                                Dossier import
                            </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input" type="radio" name="type" id="Export" value="export">
                            <label class="form-check-label" for="Export">&nbsp;
                                Dossier export
                            </label>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="Date_arrive" class="form-label">Date d'arrivé</label>
                                <input type="date" class="form-control" id="Date_arrive" name="date_arrive">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group ">
                                <label for="Date_dedouanement" class="form-label">Date Dédouanement</label>
                                <input type="date" class="form-control" id="Date_dedouanement" name="date_dedouanement">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="Heure_sortie" class="form-label">Heure de sortie</label>
                                <input type="time" class="form-control" id="Heure_sortie" name="heure_sortie">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group ">
                                <label for="ctct_receptio" class="form-label">Contact réceptionnaire</label>
                                <input type="text" class="form-control" id="Ctct_receptio" name="ctct_receptio">
                            </div>
                        </div>



                        <div class="col">
                            <div class="form-group ">
                                <label for="N_manifeste" class="form-label">N° Manifeste</label>
                                <input type="text" class="form-control" id="N_manifeste" name="n_manifeste">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="centre_cout" class="form-label">Centre Cout</label>
                                <input type="text" class="form-control" id="Centre_cout" name="centre_cout">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group ">
                                <label for="Moyen_transport" class="form-label">Moyen de Transport</label>
                                <select id="Moyen_transport" name="moyen_transport" class="form-control">
                                    <option value="routiere">Routière</option>
                                    <option value="maritime">Maritime</option>
                                    <option value="aerien">Aérien</option>
                                </select>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group ">
                                <label for="Connaissement" class="form-label">Connaissement</label>
                                <input type="text" class="form-control" id="Connaissement" name="connaissement">
                            </div>
                        </div>
                        <div class="col" id="nu_bateau" style="display: none">
                            <div class="form-group ">
                                <label for="N_bateau" class="form-label">N° Bateau</label>
                                <input type="text" class="form-control" id="N_bateau" name="n_moyen1">
                            </div>
                        </div>
                        <div class="col" id="nu_rmoq">
                            <div class="form-group ">
                                <label for="N_rmoq" class="form-label">Rmoq/Con</label>
                                <input type="text" class="form-control" id="N_rmoq" name="n_moyen2">
                            </div>
                        </div>
                        <div class="col" id="n_aerien" style="display: none">
                            <div class="form-group">
                                <label for="Aerien" class="form-label">xx</label>
                                <input type="text" class="form-control" id="Aerien" name="n_moyen3">
                            </div>
                        </div>
                        <div class="col" id="N_tcc">
                            <div class="form-group ">
                                <label for="N_tc" class="form-label">Nombre .TC</label>
                                <input type="text" class="form-control" id="N_tc" name="n_tc">
                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <div class="col">
                            <div class="form-group ">
                                <label for="Poids_brut" class="form-label">Poids Brut</label>
                                <input type="text" class="form-control" id="Poids_brut" name="poids_brut">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group ">
                                <label for="Poids_net" class="form-label">Poids Net</label>
                                <input type="text" class="form-control" id="Poids_net" name="poids_net">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group ">
                                <label for="Val_tot_declare" class="form-label">Valeur Total </label>
                                <input type="text" class="form-control" id="Val_tot_declare" name="val_tot_declare">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group ">
                                <label for="Nbr_pallette" class="form-label">Nombre de Palette</label>
                                <input type="text" class="form-control" id="Nbr_pallette" name="nbr_pallette">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group ">
                                <label for="Nbr_colis" class="form-label">Nombre de Colis</label>
                                <input type="text" class="form-control" id="Nbr_colis" name="nbr_colis">
                            </div>
                        </div>
                    </div>
                    <div>

                        {{-- <div class="col">
                            <div class="form-group">
                                <label for="Expedition" class="form-label">Expéditeur</label>
                                <input type="text" class="form-control" name="expedition" id="expedition">
                            </div>
                        </div> --}}
                        @livewire('input-client', ['inputName' => 'Expediteur' , 'destinataire' => 'destinataire' ])
                        {{-- @livewire('input-client', ['inputName' => 'Demandeur']) --}}

                        {{-- <div class="col">
                            <div class="form-group ">
                                <label for="demandeur" class="form-label">Demandeur</label>
                                <input type="text" class="form-control" id="Demandeur" name="demandeur">
                            </div>
                        </div> --}}


                    </div>


                    <div class="form-row container justify-content-right" style="margin-bottom: 3%">
                        <a href="{{ url('/formulaire') }}">
                            <button type="submit" class="btn btn-success mybtn">
                                <i class="fas fa-check"></i> &nbsp; Valider
                            </button>
                        </a>
                    </div>
                </form>
            </div>



            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            <script src="js/style.js"></script>

            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
            <script src="js/style.js"></script>
            {{--
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                crossorigin="anonymous">
            --}}
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
            <script
                src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js">
            </script>
            <script>
                const choix_moyen = document.getElementById('Moyen_transport');


const rout = document.getElementById('nu_rmoq');
const marit = document.getElementById('nu_bateau');
const aer = document.getElementById('n_aerien');
const N_tc = document.getElementById('N_tcc');
choix_moyen.addEventListener('change' , function handleChange(event) {
    if(event.target.value === 'routiere') {
        rout.style.display = 'block' ;
		N_tc.style.display = 'block' ;
        marit.style.display = 'none';
        aer.style.display = 'none';
    }
    else if (event.target.value === 'maritime') {
        marit.style.display = 'block';
        rout.style.display = 'none' ;
        aer.style.display = 'none';
		N_tc.style.display = 'none' ;
    }
    else if (event.target.value === 'aerien') {
        aer.style.display = 'block';
        marit.style.display = 'none';
        rout.style.display = 'none' ;
		N_tc.style.display = 'none' ;
    }
});

            </script>
            <script>
                var path = "{{ route('autocomplete') }}";

    $('#expedition').typeahead({
    source: function (query, process) {
    return $.get(path, {
    query: query
    }, function (data) {
    return process(data);
    });
    }
    });
            </script>
        </div>
    </div>
    @livewireScripts
</body>

@endsection
