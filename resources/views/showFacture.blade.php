@extends('layouts.admin')
@section('formule')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="container">

                @csrf

                @if (session('status'))
                <div class="alert">
                    {{ session('status') }}
                </div>
                @endif
                <br>
                <fieldset class="partie1">

                    <div class="card-header">Entête de Facture</div>
                    <br>
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
                            <input type="text" class="form-control" id="num_dossier1" value="{{$dossier->n_dossier}}"
                                disabled>
                        </div>
                        <div class="form-group col">
                            <label for="date_dossier1">Date de Dossier</label>
                            <input type="text" class="form-control" id="date_dossier1" value="{{date(" d-m-Y",
                                strtotime($dossier->date_dedouanement))}}" disabled>
                        </div>
                    </div>
                    <div class="form-row container">
                        <div class="form-group col ">
                            <label for="expediteur">Expéditeur</label>
                            <input type="text" class="form-control" id="expediteur" value="{{$dossier->expediteur}}"
                                disabled>
                        </div>

                        <div class="form-group col ">
                            <label for="nom_producteur">Nom producteur</label>
                            <input type="text" class="form-control" id="nom_producteur" disabled>
                        </div>
                        <div class="form-group col">
                            <label for="num_station">N° Station</label>
                            <input type="text" class="form-control" id="num_station" disabled>
                        </div>
                        <div class="form-group  col">
                            <label for="tel1">Tel</label>
                            <input type="text" class="form-control" id="tel1" disabled>
                        </div>
                    </div>
                    <br>
                    {{-- --------------------------------------------------------------------------------------- --}}
                    <p>Facture </p>
                    <hr>
                    <div class="form-row container">
                        <div class="form-group col">
                            <label for="Date_facture">Date Facture</label>
                            <input type="date" class="form-control" id="Date_facture" name="date_facture"
                                value="{{$factures->id_facture}}" disabled>
                        </div>
                        <div class="form-group col ">
                            <label for="Num_facture">N° Facture</label>
                            <input type="text" class="form-control" id="Num_facture" name="num_facture"
                                value="{{$factures->num_facture}}" disabled>
                        </div>

                        <div class="form-group col ">
                            <label for="Destinataire">Déstinataire</label>
                            <input type="text" class="form-control" id="Destinataire" name="destinataire"
                                value="{{$factures->destinataire}}" disabled>
                        </div>
                        <div class="form-group col ">
                            <label for="Code_destinataire">Code Déstinataire</label>
                            <input type="text" class="form-control" name="code_destinataire" id="Code_destinataire"
                                value="{{$factures->code_destinataire}}" disabled>
                        </div>
                        <div class="form-group col">
                            <label for="Adresse">Adresse</label>
                            <input type="text" class="form-control" id="Adresse" name="adresse"
                                value="{{$factures->adresse}}" disabled>
                        </div>
                        <div class="form-row container">
                            <div class="form-group col ">
                                <label for="Devise1">Devise</label>
                                <input type="text" class="form-control" id="Devise1" name="devise1"
                                    value="{{$factures->devise1}}" disabled>
                            </div>
                            <div class="form-group col ">
                                <label for="Cours1">Cours</label>
                                <input type="text" class="form-control" id="Cours1" name="cours1"
                                    value="{{$factures->cours1}}" disabled>
                            </div>
                            <div class="form-group col ">
                                <label for="Sigle">Sigle</label>
                                <input type="text" class="form-control" id="Sigle" name="sigle"
                                    value="{{$factures->sigle}}" disabled>
                            </div>
                            <div class="form-group col ">
                                <label for="Incoterm">Incoterm</label>
                                <input type="text" class="form-control" id="Incoterm" name="incoterm"
                                    value="{{$factures->incoterm}}" disabled>
                            </div>
                            <div class="form-group col ">
                                <label for="Paiement">Avec/Sans Paiement</label>
                                <select id="Paiement" name="mode_paie" class="form-control" disabled>
                                    <option value="avec">Oui</option>
                                    <option value="sans">Non</option>

                                </select>

                            </div>
                            <div class="form-row container">
                                <div class="form-group col-md-4 ">
                                    <label for="Matricule">Matricule</label>
                                    <input type="text" class="form-control" id="Matricule" name="matricule"
                                        value="{{$factures->matricule}}" disabled>
                                </div>

                                <div class="form-group col ">
                                    <label for="Poids_brut">Poids Brut</label>
                                    <input type="text" class="form-control" id="Poids_brut" name="poids_brut"
                                        value="{{$factures->poids_brut}}" disabled>
                                </div>
                                <div class="form-group col ">
                                    <label for="Poids_net">Poids Net</label>
                                    <input type="text" class="form-control" id="Poids_net" name="poids_net"
                                        value="{{$factures->poids_net}}" disabled>
                                </div>
                                <div class="form-group col ">
                                    <label for="Nbr_colid">Nbr Colis</label>
                                    <input type="text" class="form-control" id="Nbr_colid" name="nbr_colid"
                                        value="{{$factures->nbr_colid}}" disabled>
                                </div>
                                <div class="form-group col">
                                    <label for="Montant">Montant</label>
                                    <input type="text" class="form-control" id="Montant" name="montant"
                                        value="{{$factures->montant}}" disabled>
                                </div>
                            </div>
                </fieldset>
                <br>

                <div class="card-header">Ligne de Facture</div>



                <br>
                <div>




                    <table class="table table-bordered">
                        <tr>
                            <th>Code NGP</th>
                            <th>Code Article</th>
                            <th>designation</th>
                            <th>Pays</th>
                            <th>Unite_Mesure</th>
                            <th>Qte</th>
                            <th>Poids net</th>
                            <th>Valeur devise</th>

                        </tr>
                        @foreach($articles as $article)
                        <tr>
                            <td>{{ $article->Code_Nomenclature}}</td>
                            <td>{{ $article->Code_Article }}</td>
                            <td>{{ $article->Code_Article }}</td>
                            <td>{{ $article->pays}}</td>
                            <td>{{ $article->Code_Unite}}</td>
                            <td>{{ $article->qte }}</td>
                            <td>{{ $article->poids_net }}</td>
                            <td>{{ $article->valeur_devise}}</td>

                        </tr>
                        @endforeach
                    </table>

                </div>
                <div>
                    <div class="row">
                        <div class="col text-left">
                            <div class="form-row ml-3">
                                <form action="{{url('/retour/dossier')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id1" value="{{Crypt::encrypt($dossier->id) }}">
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fas fa-undo"></i> Retour
                                    </button>
                                </form>
                                &nbsp;
                                &nbsp;
                                <form action="{{url('/modifier/facture')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id1" value="{{Crypt::encrypt($factures->id) }}">
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fas fa-edit"></i> Modifier
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col text-right mr-3">
                            <form action="{{url('/article/ventiller')}}" method="POST">
                                @csrf
                                <input type="hidden" name="id1" value="{{Crypt::encrypt($factures->id) }}">
                                <button type="submit" class="btn btn-dark">
                                    <i class="fas fa-cogs"></i> Ventiler
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <style>
        .search-box ul {
            list-style: none;
            padding: 0px;
            margin: 0;
            background: white;
            border: 1px solid #ccc;
            border-top: none;
            width: 150%;

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

        .search-box ul li {
            background: white;
            padding: 5px;
            border: 1px solid #ccc;
            border-top: none;
        }

        .search-box ul li:hover {
            background: #f2f2f2;
            cursor: pointer;
        }

        .search-box input[type=text] {
            padding: 5px;
            width: 100%;
            letter-spacing: 2px;
            border: 1px solid #ccc;
            border-radius: 0px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
        }

        .search-box {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 100;
            width: 50%%;
        }

        .input-group {
            position: relative;
        }

        .input-group-append {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</div>
@endsection
