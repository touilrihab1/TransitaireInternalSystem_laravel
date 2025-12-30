@extends('layouts.admin')

@section('formule')


<head>
    <title>formulaire Dossier </title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            width: 90% !important;
            max-width: 100% !important;
        }

        a {
            color: black !important;

        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin: 20px;
            margin-bottom: 10px;
            /* Add a bottom margin of 10px */
            background-color: #fff;
        }

        .card-header {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 5px;
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
            <br>
            <div class="card-header">
                Détail du dossier
            </div>
            @csrf

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
                <label for="Num_dum">N° DUM</label>
                <input type="text" class="form-control" id="Num_dum" name="num_dum" value="1" hidden>

            </div>
            <div class="card-body">
                <div class="form-group partie2">
                    <fieldset>

                        <div class="form-group container ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="Dossier_definitive"
                                    name="dossier_definitive" value="false" <?php echo ($dossier->definitive) ?
                                'checked' :
                                '';
                                ?> disabled >
                                <label class="form-check-label" for="dossier_definitive">Dossier Définitive</label>
                            </div>
                        </div>

                        <br>
                        <div class="row container text-center">

                            <div class="col">
                                <input class="form-check-input" type="radio" name="type" id="Import" value="import"
                                    disabled <?php echo ($dossier->type_dossier == 'import') ? 'checked' : ''; ?>>
                                <label class="form-check-label " for="Import">
                                    Dossier import
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="type" id="Export" value="export"
                                    disabled <?php echo ($dossier->type_dossier == 'export') ? 'checked' : ''; ?>>
                                <label class="form-check-label " for="Export">
                                    Dossier export
                                </label>
                            </div>

                        </div>
                        <div class="container text-center">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Num_dossier" class="form-label">N° Dossier</label>
                                        <input type="text" class="form-control" id="Num_dossier" name="num_dossier"
                                            value="{{$dossier->n_dossier}}" disabled>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Date_arrive" class="form-label">Date d'arrivé</label>
                                        <input type="date" class="form-control" id="Date_arrive" disabled
                                            name="date_arrive" value="{{ $dossier->date_arrive }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Date_dedouanement" class="form-label">Date Dédouanement</label>
                                        <input type="date" class="form-control" id="Date_dedouanement" disabled
                                            name="date_dedouanement" value="{{$dossier->date_dedouanement }}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Heure_sortie" class="form-label">Heure de sortie</label>
                                        <input type="time" class="form-control" id="Heure_sortie" disabled
                                            name="heure_sortie" value="{{$dossier->heure_sortie}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Provenance">Provenance/Destination</label>
                                        <input type="text" class="form-control" id="Provenance" disabled
                                            name="provenance" value="{{$dossier->destination}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Date_dedouanement2" class="form-label">Date Dédouanement 2</label>
                                        <input type="date" class="form-control" id="Date_dedouanement2" disabled
                                            name="date_dedouanement2" value="{{$dossier->date_dedouanement2}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group "> <label for="N_manifeste" class="form-label">N°
                                            Manifeste</label>
                                        <input type="text" class="form-control" id="N_manifeste" disabled
                                            name="n_manifeste" value="{{$dossier->n_manifeste}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Transporteur" class="form-label">Transporteur</label>
                                        <input type="text" class="form-control" id="Transporteur" disabled
                                            name="transporteur" value="{{$dossier->transporteur}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Moyen_transport" class="form-label">Moyen de Transport</label>
                                        <select id="Moyen_transport" name="moyen_transport" class="form-control"
                                            disabled>
                                            <option value="routiere">Routière</option>
                                            <option value="maritime">Maritime</option>
                                            <option value="aerien">Aérien</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Connaissement" class="form-label">Connaissement</label>
                                        <input type="text" class="form-control" id="Connaissement" disabled
                                            name="connaissement" value="{{$dossier->connaissement}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3" id="nu_bateau" style="display: none">
                                    <div class="form-group ">
                                        <label for="N_bateau">N° Bateau</label>
                                        <input type="text" class="form-control" id="N_bateau" name="n_moyen1" disabled>
                                    </div>
                                </div>
                                <div class="col" id="nu_rmoq">
                                    <div class="form-group ">
                                        <label for="N_rmoq" class="form-label">Rmoq/Con</label>
                                        <input type="text" class="form-control" id="N_rmoq" name="n_moyen2" disabled>
                                    </div>
                                </div>
                                <div class="col" id="n_aerien" style="display: none">
                                    <div class="form-group ">
                                        <label for="Aerien" class="form-label">xx</label>
                                        <input type="text" class="form-control" id="Aerien" name="n_moyen3" disabled>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group "> <label for="N_tc" class="form-label">Nombre .TC</label>
                                        <input type="text" class="form-control" id="N_tc" name="n_tc" disabled
                                            value="{{$dossier->n_tc}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Poids_brut" class="form-label">Poids Brut</label>
                                        <input type="text" class="form-control" id="Poids_brut" disabled
                                            name="poids_brut" value="{{$dossier->poids_brut}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Poids_net" class="form-label">Poids Net</label>
                                        <input type="text" class="form-control" id="Poids_net" disabled name="poids_net"
                                            value="{{$dossier->poids_net}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Val_tot_declare" class="form-label">Valeur Total déclaré</label>
                                        <input type="text" class="form-control" id="Val_tot_declare" disabled
                                            name="val_tot_declare" value="{{$dossier->val_total_declare}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group "> <label for="Nbr_pallette" class="form-label">Nombre de
                                            Palette</label>
                                        <input type="text" class="form-control" id="Nbr_pallette" disabled
                                            name="nbr_pallette" value="{{$dossier->n_palette}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Nbr_colis" class="form-label">Nombre de Colis</label>
                                        <input type="text" class="form-control" id="Nbr_colis" disabled name="nbr_colis"
                                            value="{{$dossier->n_colis}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="Design_marchandise" class="form-label">Désignation de
                                            Marchandise</label>
                                        <input type="text" class="form-control" id="Design_marchandise" disabled
                                            name="design_marchandise" value="{{$dossier->designation}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group "> <label for="Expedition"
                                            class="form-label">Expédition</label>
                                        <input type="text" class="form-control" name="expedition" disabled
                                            id="Expedition" value="{{$dossier->expediteur}}">
                                    </div>
                                </div>


                                <div class="col">
                                    <div class="form-group ">
                                        <label for="demandeur" class="form-label">Demandeur</label>
                                        <input type="text" class="form-control" id="Demandeur" disabled name="demandeur"
                                            value="{{$dossier->demandeur}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="ctct_receptio" class="form-label">Contact réceptionnaire</label>
                                        <input type="text" class="form-control" id="Ctct_receptio" disabled
                                            name="ctct_receptio" value="{{$dossier->contact_receptionnaire}}">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="centre_cout" class="form-label">Centre Cout</label>
                                        <input type="text" class="form-control" id="Centre_cout" disabled
                                            name="centre_cout" value="{{$dossier->centre_cout}}">
                                    </div>
                                </div>
                            </div>

                        </div>

                        @if (auth()->user()->hasRole('dédouanement'))
                        <div style="display: flex; justify-content: space-between;">
                            <form action="{{url('/facture')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id1" value="{{Crypt::encrypt($dossier->id) }}">
                                <button type="submit" class="btn btn-info">+ajouter facture</button>
                            </form>
                            <div class="mr-4">
                                <form action="{{url('/dossier/ventiller')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id1" value="{{Crypt::encrypt($dossier->id) }}">
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fas fa-cogs"></i> Ventiler
                                    </button>
                                </form>
                            </div>
                        </div>

                        <table class="table table-hover  mt-2 ml-3">
                            <thead>
                                <tr>

                                    <th>N° Facture</th>
                                    <th>Date Facture</th>
                                    {{-- <th>Partenaire</th> --}}
                                    <th>Code devise</th>
                                    <th>Poids brut</th>
                                    <th>Poids net</th>
                                    <th>Montant</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($factures as $facture)
                                <tr>
                                    <?php if(sprintf("%07d", $facture->id) != 0000000){ ?>
                                    <td>{{sprintf("%07d", $facture->id)}}</td>
                                    <td>{{ $facture->date_facture }}</td>
                                    <td>{{ $facture->devise1 }}</td>
                                    <td>{{ $facture->poids_brut }}</td>
                                    <td>{{ $facture->poids_brut }}</td>
                                    <td>{{ $facture->montant }}</td>
                                    <td>
                                        <form action="{{url('/facture/voir')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id1" value="{{Crypt::encrypt($facture->id) }}">
                                            <button type="submit" class="btn btn-info">voir</button>

                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                                @endforeach

                            </tbody>
                        </table>


                </div>
                @endif
            </div>

            <div class="row">
                
                <div class="col-md-6 text-right">
                    @if (auth()->user()->hasRole('exploitation'))
                    <?php
            if ($dossier->Libelle_Sous_Statut != 'Dossier Complet') {
            ?>
           
<div class="row justify-content-between align-items-center ">
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <form action="{{ url('/ajouter/charge') }}" method="POST">
                @csrf
                <input type="hidden" name="id1" value="{{ Crypt::encrypt($dossier->id) }}">
                <button type="submit" class="btn btn-success ">Ajouter charge</button>
            </form>
            
           <?php }?>
           
           <button type="submit" class="btn btn-dark " data-toggle="modal" data-target="#cloturer"
           >cloturer dossier</button>


               <div wire:ignore.self class="modal fade" id="cloturer" tabindex="-1" role="dialog"
               aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
   
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">cloturer dossier</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true close-btn">×</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <p>voulez vous cloturer le dossier?</p>
                       </div>
                       <div class="modal-footer">
                           <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Annuller</button>
                           <form action="{{ url('cloturer/dossier') }}" method="POST">
                               @csrf
                               <input name="ido" id="newId1" value="{{ Crypt::encrypt($dossier->id) }}" hidden>
                               <button type="submit" class="btn btn-danger ">Oui</button>
                           </form>
   
                       </div>
                   </div>
               </div>
           </div>
            @endif
            <a class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a></div>
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
const N_tc = document.getElementById('N_tc');
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
    }
    else if (event.target.value === 'aerien') {
        aer.style.display = 'block';
        marit.style.display = 'none';
        rout.style.display = 'none' ;
    }
});

            </script>
            @livewireScripts
        </div>
</body>

@endsection
