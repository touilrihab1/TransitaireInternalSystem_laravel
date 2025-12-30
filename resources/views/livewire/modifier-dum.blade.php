{{-- <div>
    <div class="card-body">
                   
        @if (session('status'))
        <div class="alert ">
            {{session('status')}}
        </div>
        @endif
        <fieldset>
            <div class="card-header">
                Détail de la dum d'import, Dum N°:
            </div>
            <br>
            <div class="d-flex align-items-center">
                <div class="form-group col-md-5 d-flex align-items-center">
                    <label for="Num_dum" class="form-label">N° de la Dum:</label>
                    <input type="text" id="Num_dum" class="form-control w-100 ml-4" name="num_dum"
                        wire:model="num_dum" value="{{$dum->num_dum}}" disabled>
                </div>
                <div class="form-group  col-3 d-flex align-items-center">
                    <label for="Sdum" class="form-label">N° de la sous Dum:</label>
                    <input type="text" value="{{$dum->num_sous_dum}}" name="sdum" class="form-control w-100 ml-4" disabled>
                </div>
                <div class="d-flex align-items-center ml-4">
                    <span class="mr-2">Etat</span>
                    <input class="form-check-input ml-5" type="checkbox" value="" id="flexCheckDisabled" disabled>
                    <label class="form-check-label ml-5" for="flexCheckDisabled">
                        DUM validate
                    </label>
                </div>
            </div>
        </fieldset>
        <div class="card-header"> Identification
        </div>
        <div class="row">
    
            <div class="col">
                <div class="form-group">
                    <label for="Bureau_dedouanement" class="form-label">Bureau de dédouanement:</label>
                    <div class="input-group" style="position:relative;">
                        <input type="text" class="form-control" value="{{$dum->bureau_dedouanement}}" id="Bureau_d" name="bureau_dedouanement"
                            wire:model="search" wire:keyup="searchResult" >
                    
                        
                    </div>
                </div>
            </div>
    
            <div class="col">
                <div class="form-group">
                    <label for="Arrandissement" class="form-label">Arrondissment:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{$dum->arrondissement}}" id="Arrond" name="arrondissement"
                            wire:model="search_arrondissement" wire:keyup="searchResult1" >
                      
                    </div>
                </div>
            </div>
    
            <div class="col">
                <div class="form-group">
                    <label for="Bureau_destination" class="form-label">Bureau destination:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{$dum->bureau_destination}}" id="Bureau_destination"
                            name="bureau_destination" wire:model="search_dest" wire:keyup="searchDest" >
                       
                    </div>
                </div>
            </div>
    
            <div class="col">
                <div class="form-group">
                    <label for="Regime" class="form-label">Regime:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="{{$dum->regime}}" id="Regime" name="regime"
                            wire:model="search_regime" wire:keyup="searchRegime" >
           
                        
                    </div>
                </div>
            </div>
    
        </div>
    
        <div class="form-row container mr-4">
            <div class="form-group col ">
                <label for="N_serie" class="form-label">N° Série:</label>
                <input type="text" class="form-control" value="{{$dum->n_serie}}" id="N_serie" name="n_serie" wire:model="serie"
                    wire:change="updateNumDum" >
            </div>
            <div class="form-group col ">
                <label for="Lettre" class="form-label">Lettre:</label>
                <input type="text" class="form-control" value="{{$dum->lettre}}" id="Lettre" name="lettre" wire:model="lettre"
                    wire:change="updateNumDum" >
            </div>
            <div class="form-group col ">
                <label for="Repertoire" class="form-label">Répertoire:</label>
                <input type="text" class="form-control" value="{{$dum->repertoire}}" id="Repertoire" name="repertoire" >
            </div>
    
        </div>
        <div class="form-row container">
            <div class="form-group col-md ">
                <label for="Date_debut" class="form-label">Date Début:</label>
                <input type="date" class="form-control" value="{{$dum->date_debut}}" name="date_debut" >
            </div>
            <div class="form-group col-md ">
                <label for="Date_fin" class="form-label">Date Fin:</label>
                <input type="date" class="form-control" value="{{$dum->date_fin}}" name="date_fin" >
            </div>
    
            <div class="form-group col-md">
                <label for="Declaration" class="form-label">Declaration:</label>
                <div class="input-group">
          <input type="text" class="form-control" value="{{$dum->declaration}}" >
                </div>
            </div>
            <div class="form-group col-md">
                <label for="Devise" class="form-label">Devise:</label>
                <input class="form-control" value="{{$dum->devise}}" wire:model="selectedDevise" name="devise" >
                  
             
            </div>
    
            <div class="form-group col-md">
                <label for="Cours" class="form-label">Cours:</label>
                <input type="text" class="form-control" id="Cours" wire:model="cours" >
            </div>
        </div>
    
        <div class="card-header">
            Client:
        </div>
        <div class="form-row container">
            <div class="form-group col-md-3">
                <label for="Raison_sociale" class="form-label">Raison Sociale:</label>
                <div class="input-group">
                    <input type="text" id="Raison_sociale" name="Raison_sociale" class="form-control"
                        value="{{$client->Raison_Sociale}}" >
            
                </div>
    
            </div>
            <div class="form-group col-md-3">
                <label for="Code_client" class="form-label">Code Client:</label>
                <input type="text" id="Code_client" name="Code_Tiers" class="form-control" value="{{$client->Code_Tiers}}" >
            </div>
    
            <div class="form-group col-md-3">
                <label for="Adresse" class="form-label">Adresse:</label>
                <input type="text" id="Adresse" name="Adresse" class="form-control" value="{{$client->Adresse}}" >
            </div>
            <div class="form-group col-md-3">
                <label for="Ville" class="form-label">Ville:</label>
                <input type="text" id="Ville" name="Ville" class="form-control" value="{{$client->Ville}}" >
            </div>
    
    
        </div>
        <br>
        <div class="form-row container justify-content-center mr-4 " style="margin-bottom: 2% ">
         
       
    
            <a href="{{ url()->previous() }}">
                <button type="button" class="btn btn-dark mybtn"><i class="fas fa-undo"></i> Retour</button>
            </a>
            &nbsp;&nbsp;&nbsp;
        </div>
    
    </div>
    </div> --}}
   <div>
    {{$dum->id}}
   </div>