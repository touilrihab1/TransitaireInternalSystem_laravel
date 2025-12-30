<div>
    <div>
        <form action="/ajouter/facture" method="POST" id="form">


            <br>
            @csrf
            <br>
            {{-- @if (session('status'))
            <div class="alert ">
                {{session('status')}}
            </div>
            @endif --}}
           @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            {{-- @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif

            @if (Session::has('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div> 
            @endif--}}
            <fieldset class="partie1">
                <div class="card-header">Entête de Facture </div>

                {{-- <p>DUM</p> --}}

                <div class="form-row container">
                    <div class="form-group col-sm-2 ">
                        <label for="num_dum1" class="form-label">N° DUM</label>
                        <input type="text" class="form-control " id="num_dum1" disabled>
                    </div>
                    <div class="form-group col-sm-2 ">
                        <label for="importeur" class="form-label">Importeur</label>
                        <input type="text" class="form-control" id="importeur" disabled>
                    </div>
                </div>

                {{-- <p>Dossier</p> --}}

                <div class="form-row container">

                    <div class="form-group col-md-4 ">
                        <label for="num_dossier1" class="form-label">N° Dossier</label>
                        <input type="text" class="form-control" id="num_dossier1" value="{{$dossier->n_dossier}}"
                            disabled>

                    </div>

                    <div class="form-group col-md-4 ">
                        <label for="date_dossier1" class="form-label">Date de Dossier</label>
                        <input type="text" class="form-control" id="date_dossier1" value="{{date(" d-m-Y",
                            strtotime($dossier->date_dedouanement))}}" disabled>
                    </div>
                    <div class="form-group col-">
                        <label for="expediteur" class="form-label">Expéditeur </label>
                        <input type="text" class="form-control" id="expediteur" disabled>
                    </div>
                </div>

                <div class="form-row container">
                    <div class="form-group col ">
                        <label for="nom_producteur" class="form-label">Nom producteur</label>
                        <input type="text" class="form-control" id="nom_producteur" disabled>
                    </div>
                    <div class="form-group col ">
                        <label for="num_station" class="form-label">N° Station</label>
                        <input type="text" class="form-control" id="num_station" disabled>
                    </div>
                    <div class="form-group col ">
                        <label for="tel1" class="form-label">Tel</label>
                        <input type="text" class="form-control" id="tel1" disabled>
                    </div>
                </div>

                <div class="card-header">Facture </div>

                <div class="form-row container">
                    <div class="form-group col ">
                        <label for="Date_facture" class="form-label">Date Facture</label>
                        <input type="date" class="form-control" id="Date_facture" name="date_facture">
                    </div>
                    <div class="form-group col ">
                        <label for="Num_facture" class="form-label">N° Facture</label>
                        <input type="text" class="form-control" id="Num_facture" name="num_facture">
                    </div>
                    <div class="form-group col ">
                        <label for="Destinataire" class="form-label">Déstinataire</label>
                        <input type="text" class="form-control" id="Destinataire" name="destinataire">
                    </div>
                    <div class="form-group col ">
                        <label for="Code_destinataire" class="form-label">Code Déstinataire</label>
                        <input type="text" class="form-control" name="code_destinataire" id="Code_destinataire">
                    </div>
                    <div class="form-group col ">
                        <label for="Adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="Adresse" name="adresse">
                    </div>
                </div>

                <div class="form-row container">


                    <div class="form-group col ">
                        <label for="Devise1" class="form-label">Devise</label>
                        <select class="form-control" id="Devise" name="devise">
                            @foreach ($devise as $dv)
                            <option value="{{ $dv->Code_Devise }}">{{ $dv->Intitule_Devise }} ({{
                                $dv->Code_Devise
                                }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col ">
                        <label for="Cours1" class="form-label">Cours</label>
                        <input type="text" class="form-control" id="Cours1" name="cours1" value="{{ old('cours1') }}">
                    </div>
                    <div class="form-group col ">
                        <label for="Sigle" class="form-label">Sigle</label>
                        <input type="text" class="form-control" id="Sigle" name="sigle" value="{{ old('sigle') }}">
                    </div>
                    <div class="form-group col ">
                        <label for="Incoterm">Incoterm</label>
                        <select class="form-control" id="incoterm" name="incoterm">
                            @foreach ($incoterm as $dv)
                            <option value="{{ $dv->Code_Incoterm }}">{{ $dv->Intitule_Incoterm }}
                                ({{$dv->Code_Incoterm
                                }} ) </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col ">
                        <label for="Paiement" class="form-label">Avec/Sans Paiement</label>
                        <select id="Paiement" name="mode_paie" class="form-control">
                            <option value="avec">Oui</option>
                            <option value="sans">Non</option>

                        </select>

                    </div>
                </div>
                <div class="form-row container">


                    <div class="form-group col">
                        <label for="Matricule" class="form-label">Matricule</label>
                        <input type="text" class="form-control" id="Matricule" name="matricule">
                    </div>

                    <div class="form-group col">
                        <label for="Poids_brut" class="form-label">Poids Brut</label>

                        <input type="text" class="form-control" id="Poids_brut" name="poids_brut" 
                        wire:model="poids_brut">

                    </div>
                    @error('poids_brut')
                    <span class="text-danger error">{{ $message }}</span>
                    @enderror

                    <div class="form-group col">
                        <label for="Poids_net" class="form-label">Poids Net</label>

                        <input type="text" class="form-control" id="PoidNet" name="poids_net" wire:model="poids_netE">

                        
                        @if (!empty($poids_brut) && $poids_netE > $poids_brut)
                        <span class="text-danger error">Poids Net cannot be greater than Poids Brut.</span>
                        @endif
                    </div>
                    <div class="form-group col ">
                        <label for="Nbr_colid" class="form-label">Nbr Colis</label>
                        <input type="text" class="form-control" id="Nbr_colid" name="nbr_colid">
                    </div>
                    <div class="form-group col ">
                        <label for="Montant" class="form-label">Montant</label>
                        <input type="text" class="form-control" id="Montant" name="montant">
                    </div>
                </div>
            </fieldset>
            <br>
            <div id="ligne_facture">
                <div class="card-header">Ligne de Facture </div>

                <div id="erreurBarre" style="background-color: red  ; color: #f2f2f2 ; display: none">somme des Poids
                    Net des articles
                    differentes au Poids Net de la facture</div>


                <br>


                <div class="add-input">
                    <div class="row">

                        <div class=" form-group col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter code NGP"
                                    wire:model="code_ngp" wire:keyup="searchNgp" name="val1">
                                @if($showdiv_ngp)
                                <div class="search-box" style="position:absolute;top:100%;left:0;">
                                    <ul>
                                        @if(!empty($records_ngp))
                                        @foreach($records_ngp as $record)
                                        <li wire:click="fetchNgp('{{ $record->Code_Nomenclature }}')">
                                            {{ $record->Code_Nomenclature }}
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Code Article"
                                    wire:model="code_article" wire:keyup="searchArticle">
                                @error('code_article')
                                <span class=" text-danger error">{{ $message}}</span>
                                @enderror
                                @if($showdiv_article)
                                <div class="search-box" style="position:absolute;top:100%;left:0;">
                                    <ul>
                                        @if(!empty($records_article))
                                        @foreach($records_article as $record)
                                        <li wire:click="fetchArticle('{{ $record->Code_Article }}')">
                                            {{ $record->Code_Article }}
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter designation"
                                    wire:model="designation" wire:keyup="searchDesign">
                                @error('designation') <span class="text-danger error">{{ $message }}</span>@enderror
                                @if($showdiv_design)
                                <div class="search-box" style="position:absolute;top:100%;left:0;">
                                    <ul>
                                        @if(!empty($records_design))
                                        @foreach($records_design as $record)
                                        <li wire:click="fetchDesign('{{ $record->Designation_Article }}')">
                                            {{ $record->Designation_Article }}
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Pays" wire:model="pays"
                                    wire:keyup="searchPays">
                                @error('pays') <span class="text-danger error">{{ $message }}</span>@enderror
                                @if($showdiv_pays)
                                <div class="search-box" style="position:absolute;top:100%;left:0;">
                                    <ul>
                                        @if(!empty($records_pays))
                                        @foreach($records_pays as $record)
                                        <li wire:click="fetchPays('{{ $record->Intitule_Origine }}')">
                                            {{ $record->Intitule_Origine }}
                                        </li>
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group col">
                            <div class="form-group">
                                <div class="input-group" style="position:relative;">
                                    <input type="text" class="form-control" placeholder="Enter Unite_Mesure"
                                        wire:model="unityMesureSearch" wire:keyup="searchResult" name="Unite_Mesure">
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

                        <div class="form-group col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Qte" wire:model="Qte">
                                @error('Qte') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group col">
                            <div class="form-group">
                                <input type="text"  class="form-control" placeholder="Enter Poids Net"
                                    wire:model="poids_net" value="">
                                @error('poids_net') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group col">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter Valeur devise"
                                    wire:model="valeur_devise">
                                @error('valeur_devise') <span class="text-danger error">{{ $message
                                    }}</span>@enderror
                            </div>
                        </div>

                        <div class="form-group col">
                            <button type="button" wire:click.prevent="store()" class="btn btn-dark btn-sm">+ajouter
                                article</button>
                        </div>

                    </div>
                </div>
                @if ($errors->has('poids_net_sum'))
                <span class="text-danger error">{{ $errors->first('poids_net_sum') }}</span>
                @endif
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
                        <td >{{ $article['code_ngp'] }}</td>
                        <td>{{ $article['code_article'] }}</td>
                        <td>{{ $article['designation'] }}</td>
                        <td>{{ $article['pays'] }}</td>
                        <td>{{ $article['Unite_Mesure'] }}</td>
                        <td>{{ $article['Qte'] }}</td>
                        <td class="net">{{ $article['poids_net'] }}</td>
                        <td>{{ $article['valeur_devise'] }}</td>

                        <td>
                            <div class="col-md-2">
                                <button class="btn btn-danger btn-sm"
                                    wire:click.prevent="removeItem({{ $key }})">Remove</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>


            </div>





            @csrf
            <input name="id1" value="{{$id1}}" hidden>
            <div class="row justify-content-between align-items-start">
                {{-- <div class="col-auto ml-3">
                    <button type="submit" class="btn btn-secondary mybtn" name="ajouter_facture">
                        <i class="fas fa-plus"> &nbsp; Ajouter facture</i>
                    </button>
                </div> --}}

                <div class="col-auto mr-3">
                    {{-- <button  class="btn btn-success mybtn" type="submit" name="valide">
                        <i class="fas fa-check">&nbsp; Valider</i>
                    </button> --}}
                    <input type="button" class="btn btn-success mybtn" onclick="comparer()" value="Valider">
                </div>

            </div>
        </form>

        <style>
            .form-group-container {
                margin-bottom: 1rem;
            }

            .form-group-container label {
                font-weight: bold;
            }

            .form-group-container input[type="text"],
            .form-group-container select {
                width: 100%;
            }

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

            .container {
                width: 95% !important;
                max-width: 100% !important;
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
                width: 95% !important;
            }

            .card-header {
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
    </div>
   

    <script>

     
      function comparer() {
        let somme = 0 ;
        let form = document.getElementById('form') ;
        let net = document.getElementsByClassName('net') ;
        let PoidNet = document.getElementById('PoidNet');
        let erreurBarre = document.getElementById('erreurBarre') ;
        for(let i = 0; i < net.length; i++) {
           
           somme = somme + parseInt(net[i].innerText); 
        //    console.log(parseInt(net[i].innerText));
            }
         
      
        if(somme == parseInt(PoidNet.value))
        {
            form.submit() ;
            console.log('egale') ;
            console.log(somme) ;
        }
         else //if( somme != PoidNet)
        {
            console.log('different') ;
            console.log(somme) ;
            erreurBarre.style.display = "block" ;
        }

        
      
      }

    </script>
</div>
