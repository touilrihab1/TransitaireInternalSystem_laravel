<div>
    <div>
        <div>
            <form action="/save/modification/facture" method="POST">
                <div class="container ">

                    @csrf
                    <br>
                    @if (session('status'))
                    <div class="alert ">
                        {{session('status')}}
                    </div>
                    @endif

                    <fieldset class="partie1">

                        <p>Facture </p>

                        <div class="form-row container">
                            <div class="form-group col ">
                                <label for="Date_facture">Date Facture</label>
                                <input type="date" class="form-control" id="Date_facture" name="date_facture">
                            </div>
                            <div class="form-group col ">
                                <label for="Num_facture">N° Facture</label>
                                <input type="text" class="form-control" id="Num_facture"
                                    value="{{$factures->num_facture}}" name="num_facture">
                            </div>
                            <input name="idFacture" value="{{Crypt::encrypt($factures->id)}}" hidden>

                            <div class="form-group col ">
                                <label for="Destinataire">Déstinataire</label>
                                <input type="text" class="form-control" id="Destinataire"
                                    value="{{$factures->destinataire}}" name="destinataire">
                            </div>
                            <div class="form-group col">
                                <label for="Code_destinataire">Code Déstinataire</label>
                                <input type="text" class="form-control" name="code_destinataire"
                                    value="{{$factures->code_destinataire}}" id="Code_destinataire">
                            </div>
                            <div class="form-group col ">
                                <label for="Adresse">Adresse</label>
                                <input type="text" class="form-control" id="Adresse" value="{{$factures->adresse}}"
                                    name="adresse">
                            </div>
                        </div>
                        <div class="form-row container">
                            <div class="form-group col ">
                                <label for="Devise1">Devise</label>
                                <input type="text" class="form-control" id="Devise1" value="{{$factures->devise1}}"
                                    name="devise1">
                            </div>
                            <div class="form-group col ">
                                <label for="Cours1">Cours</label>
                                <input type="text" class="form-control" id="Cours1" value="{{$factures->cours1}}"
                                    name="cours1">
                            </div>
                            <div class="form-group col ">
                                <label for="Sigle">Sigle</label>
                                <input type="text" class="form-control" id="Sigle" value="{{$factures->sigle}}"
                                    name="sigle">
                            </div>
                            <div class="form-group col ">
                                <label for="Incoterm">Incoterm</label>
                                <input type="text" class="form-control" id="Incoterm" value="{{$factures->incoterm}}"
                                    name="incoterm">
                            </div>
                            <div class="form-group col ">
                                <label for="Paiement">Avec/Sans Paiement</label>
                                <select id="Paiement" name="mode_paie" class="form-control">
                                    <option value="avec">Oui</option>
                                    <option value="sans">Non</option>

                                </select>

                            </div>

                        </div>
                        <div class="form-row container">
                            <div class="form-group col ">
                                <label for="Matricule">Matricule</label>
                                <input type="text" class="form-control" id="Matricule" name="matricule"
                                    value="{{$factures->matricule}}">
                            </div>
                            <div class="form-group col ">
                                <label for="Poids_brut">Poids Brut</label>
                                <input type="text" class="form-control" id="Poids_brut"
                                    value="{{$factures->poids_brut}}" name="poids_brut">
                            </div>
                            <div class="form-group col ">
                                <label for="Poids_net">Poids Net</label>
                                <input type="text" class="form-control" id="Poids_net" value="{{$factures->poids_net}}"
                                    name="poids_net">
                            </div>
                            <div class="form-group col">
                                <label for="Nbr_colid">Nbr Colis</label>
                                <input type="text" class="form-control" id="Nbr_colid" value="{{$factures->nbr_colid}}"
                                    name="nbr_colid">
                            </div>
                            <div class="form-group col ">
                                <label for="Montant">Montant</label>
                                <input type="text" class="form-control" id="Montant" value="{{$factures->montant}}"
                                    name="montant">
                            </div>
                        </div>
                    </fieldset>
                    <br>
                    <legend style="background-color: #E6E2E2">Ligne de Facture </legend>




                    <div>



                        <div class="add-input">
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter code NGP"
                                            wire:model="code_ngp">
                                        @error('code_ngp') <span class="text-danger error">{{ $message
                                            }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Code Article"
                                            wire:model="code_article">
                                        @error('code_article') <span class="text-danger error">{{ $message
                                            }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter designation"
                                            wire:model="designation">
                                        @error('designation') <span class="text-danger error">{{ $message
                                            }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Pays"
                                            wire:model="pays">
                                        @error('pays') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group" style="position:relative;">
                                            <input type="text" class="form-control" placeholder="Enter Unite_Mesure"
                                                wire:model="unityMesureSearch" wire:keyup="searchResult"
                                                name="Unite_Mesure">
                                            @if($showdiv)
                                            <div class="search-box" style="position:absolute;top:100%;left:0;">
                                                <ul>
                                                    @if(!empty($records))
                                                    @foreach($records as $record)
                                                    <li wire:click="fetchEmployeeDetail('{{ $record->Code_Unite }}')">
                                                        {{ $record->Code_Unite }}
                                                    </li>
                                                    @endforeach
                                                    @endif
                                                </ul>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Qte"
                                            wire:model="Qte">
                                        @error('Qte') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Poids Net"
                                            wire:model="poids_net">
                                        @error('poids_net') <span class="text-danger error">{{ $message
                                            }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Enter Valeur devise"
                                            wire:model="valeur_devise">
                                        @error('valeur_devise') <span class="text-danger error">{{ $message
                                            }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <button type="button" wire:click.prevent="store()"
                                        class="btn btn-dark btn-sm">+ajouter article</button>
                                </div>

                            </div>
                        </div>

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
                                <th></th>
                            </tr>

                            @foreach($data as $key => $article)
                            <tr name="beispiel">
                                <td>{{ $article['code_ngp'] }}</td>
                                <td>{{ $article['code_article'] }}</td>
                                <td>{{ $article['designation'] }}</td>
                                <td>{{ $article['pays'] }}</td>
                                <td>{{ $article['Unite_Mesure'] }}</td>
                                <td>{{ $article['Qte'] }}</td>
                                <td>{{ $article['poids_net'] }}</td>
                                <td>{{ $article['valeur_devise'] }}</td>

                                <td>
                                    <div class="col-md-2">
                                        <button class="btn btn-danger btn-sm"
                                            wire:click.prevent="removeItem({{ $key }})"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                    </div>




                </div>


                @csrf
                <input name="id1" value="{{$id1}}" hidden>
                <div class="form-row container justify-content-center">

                    <button type="submit" class="btn btn-success mybtn " name="valide"><i class="fas fa-edit"></i>
                        &nbsp; Modifier</button>
                </div>

            </form>
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
    </div>
