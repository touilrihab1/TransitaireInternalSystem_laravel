@extends('layouts.admin')

@section('formule')


<head>
    <title>formulaire Dossier </title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a {
            color: black !important;

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

        ~.card-header {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #5c5c59;
            padding: 3px 7px;
            line-height: normal;
            background-color: transparent;
            box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;
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
    <div class="container ">
        <div class="card">


            <form action='/ajouter/modification' method="POST">

                <br>
                @csrf
                <input type="hidden" name="id" value="{{Crypt::encrypt($dossier->id)}}">
                <br>
                @if (session('status'))
                <div class="alert ">
                    {{session('status')}}
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>
                @endif

                <div class="form-group col-md-4 " style="display: none">
                    <label for="Num_dum" class="form-label">N° DUM</label>
                    <input type="text" class="form-control" id="Num_dum" name="num_dum" value="1" hidden>

                </div>
                <div class="form-group partie2">
                    <fieldset>
                        <div class="card-header">
                            Détail du dossier
                        </div>
                        <br>
                        <div class="form-group container ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Dossier_definitive"
                                    name="dossier_definitive" value="false" <?php echo ($dossier->definitive) ?
                                'checked' : ''; ?>> &nbsp;
                                <label class="form-check-label" for="dossier_definitive">Dossier Définitive</label>
                            </div>
                        </div>

                        <br>
                        <div class="row container ml-1">

                            <div class="col">
                                <input class="form-check-input" type="radio" name="type" id="Import" value="import"
                                    <?php echo ($dossier->type_dossier == 'import') ? 'checked' : ''; ?>>&nbsp;
                                <label class="form-check-label " for="Import">
                                    Dossier import
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="type" id="Export" value="export"
                                    <?php echo ($dossier->type_dossier == 'export') ? 'checked' : ''; ?>>&nbsp;
                                <label class="form-check-label " for="Export">
                                    Dossier export
                                </label>
                            </div>

                        </div><br>
                        <div class="container text-center">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Num_dossier" class="form-label">N° Dossier</label>
                                        <input type="text" class="form-control" id="Num_dossier" name="num_dossier"
                                            value="{{$dossier->n_dossier}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Date_arrive" class="form-label">Date d'arrivé</label>
                                        <input type="date" class="form-control" id="Date_arrive" name="date_arrive"
                                            value="{{ $dossier->date_arrive }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Date_dedouanement" class="form-label">Date Dédouanement</label>
                                        <input type="date" class="form-control" id="Date_dedouanement"
                                            name="date_dedouanement" value="{{ $dossier->date_dedouanement }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Heure_sortie" class="form-label">Heure de sortie</label>
                                        <input type="time" class="form-control" id="Heure_sortie" name="heure_sortie"
                                            value="{{$dossier->heure_sortie}}">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Provenance" class="form-label">Destination</label>
                                        <input type="text" class="form-control" id="Provenance" name="provenance"
                                            value="{{$dossier->destination}}">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group ">
                                        <label for="N_manifeste" class="form-label">N° Manifeste</label>
                                        <input type="text" class="form-control" id="N_manifeste" name="n_manifeste"
                                            value="{{$dossier->n_manifeste}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Transporteur" class="form-label">Transporteur</label>
                                        <input type="text" class="form-control" id="Transporteur" name="transporteur"
                                            value="{{$dossier->transporteur}}">
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
                                        <input type="text" class="form-control" id="Connaissement" name="connaissement"
                                            value="{{$dossier->connaissement}}">
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
                                    <div class="form-group ">
                                        <label for="Aerien" class="form-label">xx</label>
                                        <input type="text" class="form-control" id="Aerien" name="n_moyen3">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group ">
                                        <label for="N_tc" class="form-label">Nombre .TC</label>
                                        <input type="text" class="form-control" id="N_tc" name="n_tc"
                                            value="{{$dossier->n_tc}}">
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                @if(auth()->user()->hasPermissionTo('modifier poids brut'))
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Poids_brut" class="form-label">Poids Brut</label>
                                        <input type="text" class="form-control" id="Poids_brut" name="poids_brut"
                                            value="{{$dossier->poids_brut}}">
                                    </div>
                                </div>
                                @endif
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Poids_net" class="form-label">Poids Net</label>
                                        <input type="text" class="form-control" id="Poids_net" name="poids_net"
                                            value="{{$dossier->poids_net}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Val_tot_declare" class="form-label">Valeur Total déclaré</label>
                                        <input type="text" class="form-control" id="Val_tot_declare"
                                            name="val_tot_declare" value="{{$dossier->val_total_declare}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Nbr_pallette" class="form-label">Nombre de Palette</label>
                                        <input type="text" class="form-control" id="Nbr_pallette" name="nbr_pallette"
                                            value="{{$dossier->n_palette}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Nbr_colis" class="form-label">Nombre de Colis</label>
                                        <input type="text" class="form-control" id="Nbr_colis" name="nbr_colis"
                                            value="{{$dossier->n_colis}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Design_marchandise" class="form-label">Désignation
                                            Marchandise</label>
                                        <input type="text" class="form-control" id="Design_marchandise"
                                            name="design_marchandise" value="{{$dossier->designation}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Expedition" class="form-label">Expédition</label>
                                        <input type="text" class="form-control" name="expedition" id="Expedition"
                                            value="{{$dossier->expediteur}}">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group ">
                                        <label for="demandeur" class="form-label">Demandeur</label>
                                        <input type="text" class="form-control" id="Demandeur" name="demandeur"
                                            value="{{$dossier->demandeur}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="ctct_receptio" class="form-label">Contact réceptionnaire</label>
                                        <input type="text" class="form-control" id="Ctct_receptio" name="ctct_receptio"
                                            value="{{$dossier->contact_receptionnaire}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="centre_cout" class="form-label">Centre Cout</label>
                                        <input type="text" class="form-control" id="Centre_cout" name="centre_cout"
                                            value="{{$dossier->centre_cout}}">
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-row container justify-content-center " style="margin-bottom: 2% ">
                            <a href="{{ url('/tableDossier') }}">
                                <button type="submit" class="btn btn-success mybtn"><i class="fas fa-edit"></i></button>
                            </a>
                        </div>

            </form>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <script>
        const choix_moyen = document.getElementById('Moyen_transport');
const rout = document.getElementById('nu_rmoq');
const marit = document.getElementById('nu_bateau');
const aer = document.getElementById('n_aerien');

choix_moyen.addEventListener('change' , function handleChange(event) {
    if(event.target.value === 'routiere') {
        rout.style.display = 'block' ;
        marit.style.display = 'none';
        aer.style.display = 'none';
    }
    else if (event.target.value === 'maritime') {
        marit.style.display = 'block';
        rout.style.display = 'none' ;
        aer.style.display = 'none';
    }
    else if (event.target.value === 'aerien') {
        aer.style.display = 'block';
        marit.style.display = 'none';
        rout.style.display = 'none' ;
    }
});

    </script>
</body>

@endsection
