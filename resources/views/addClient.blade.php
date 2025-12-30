@extends('layouts.admin')

@section('formule')

<head>
    <title>Formulaire Dossier</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .container {
            width: 90% !important;
            height: 110% !important;
            max-width: 90% !important;
            max-height: 100% !important;
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
            width: auto !important;
            max-width: 110%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <br>
            <br>
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-user"></i> Identification</h5>
            </div>
            <div class="card-body">
                <form action="/ajouter/traitement" method="POST">
                    @csrf

                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="code_client">Code Client</label>
                            <input type="text" class="form-control" id="code_client" name="Code_Tiers">
                        </div>
                        <div class="form-group col">
                            <label for="Raison_sociale">Raison Sociale</label>
                            <input type="text" class="form-control" id="Raison_sociale" name="Raison_Sociale">
                        </div>
                        <div class="form-group col">
                            <label for="Type_client">Type Client</label>
                            <select id="Type_client" name="type_client" class="form-control">
                                <option value="client">Client</option>
                                <option value="producteur">Producteur</option>
                                <option value="deux">Les Deux</option>
                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Periode_paiement">Période paiement</label>
                            <input type="text" class="form-control" id="Periode_paiement" name="periode_paiement">
                        </div>
                    </div>

                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-map-marker-alt"></i> Coordonnée</h5>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" name="Adresse" id="Adresse">
                        </div>
                        <div class="form-group col">
                            <label for="Code_postale">Code Postale</label>
                            <input type="text" class="form-control" id="Code_postale" name="Code_Postale">
                        </div>
                        <div class="form-group col">
                            <label for="Ville">Ville</label>
                            <input type="text" class="form-control" name="Ville" id="Ville">
                        </div>
                        <div class="form-group col">
                            <label for="Pays">Pays</label>
                            <?php
                            use App\Models\origin;
                            $origine = origin::all() ; 
                            ?>
                             <select class="form-control" id="Devise"  name="Pays">
                             <option value="">Pays</option>
                             @foreach ($origine as $dv)
                             <option value="{{ $dv->Intitule_Origine }}">{{ $dv->Intitule_Origine }} 
                             </option>
                             @endforeach
                             </select>
                        </div>
                    </div>

                    <div class="form-row ">
                        <div class="form-group col">
                            <label for="Eacce1">E.A.C.C.E. N°1</label>
                            <input type="text" class="form-control" id="Eacce1" name="NUM_EACCE1">
                        </div>
                        <div class="form-group col">
                            <label for="Eacce2">E.A.C.C.E. N°2</label>
                            <input type="text" class="form-control" id="Eacce2" name="NUM_EACCE2">
                        </div>
                        <div class="form-group col">
                            <label for="Eacce3">E.A.C.C.E. N°3</label>
                            <input type="text" class="form-control" id="Eacce3" name="NUM_EACCE3">
                        </div>
                        <div class="form-group col">
                            <label for="N_rc">N° RC</label>
                            <input type="text" class="form-control" id="N_rc" name="Num_RC">
                        </div>
                        <div class="form-group col">
                            <label for="N_centre">N° Centre</label>
                            <input type="text" class="form-control" id="N_centre" name="Num_Centre">
                        </div>
                        <div class="form-group col">
                            <label for="ICE">ICE</label>
                            <input type="text" class="form-control" id="ICE" name="ice">
                        </div>
                       

                    </div>



                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-phone"></i> Télécommunication</h5>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="Tel1">Tél 1</label>
                            <input type="text" class="form-control" name="Tel1  " id="Tel1">
                        </div>
                        <div class="form-group col">
                            <label for="Tel2">Tél 2</label>
                            <input type="text" class="form-control" name="tel2" id="Tel2">
                        </div>
                        <div class="form-group col">
                            <label for="Fax">Fax</label>
                            <input type="text" class="form-control" id="Fax" name="Fax">
                        </div>
                        <div class="form-group col">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="Email" name="email">
                        </div>
                    </div>

                    <div class="form-row container justify-content-center" style="margin-bottom: 2%">
                        <button type="submit" class="btn btn-success mybtn"><i class="fas fa-check"></i>
                            Valider</button>
                        <button id="mybtn_supprimer" class="btn btn-secondary mybtn"><i class="fas fa-trash"></i>
                            Supprimer</button>
                        <a href="{{ url()->previous() }}">
                            <button type="button" class="btn btn-dark mybtn"><i class="fas fa-arrow-left"></i>
                                Retour</button>
                        </a>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    <script type="text/javascript">
        var availablepays = ["Afghanistan", "Albanie", "Algérie", "Allemagne", "Andorre", "Angola", "Antigua-et-Barbuda", "Arabie saoudite", "Argentine", "Arménie",
	"Australie", "Autriche", "Azerbaïdjan" ,"Bahamas",
"Bahreïn",
"Bangladesh",
"Barbade",
"Belgique",
"Bélize",
"Bénin",
"Bermudes",
"Bhutan",
"Biélorussie",
"Maroc",
"Spain",
"France",

];
	$( "#Pays" ).autocomplete({
	  source: availablepays
	});
    </script>
</body>

@endsection
