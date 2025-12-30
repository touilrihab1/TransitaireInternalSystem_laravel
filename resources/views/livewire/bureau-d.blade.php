<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="card-body">
        <form action="/ajouter/dum" method="POST">
            @csrf
            @if (session('status'))
            <div class="alert ">
                {{session('status')}}
            </div>
            @endif
            <input value="{{$id_dossier}}" name="id_dossier" hidden>
            <fieldset>
                <div class="card-header">
                    Détail de la dum d'import, Dum N°:
                </div>
                <br>
                <div class="d-flex align-items-center">
                    <div class="form-group col-md-5 d-flex align-items-center">
                        <label for="Num_dum" class="form-label">N° de la Dum:</label>
                        <input type="text" id="Num_dum" class="form-control w-100 ml-4" name="num_dum"
                            wire:model="num_dum" value="" disabled>
                    </div>
                    <div class="form-group  col-3 d-flex align-items-center">
                        <label for="Sdum" class="form-label">N° de la sous Dum:</label>
                        <input type="text" id="Sdum" name="sdum" class="form-control w-100 ml-4">
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
                            <input type="text" class="form-control" value="" id="Bureau_d" name="bureau_dedouanement"
                                wire:model="search" wire:keyup="searchResult">
                            @if($showdiv)
                            <div class="search-box" style="position:absolute;top:100%;left:0;">
                                <ul>
                                    @if(!empty($records))
                                    @foreach($records as $record)
                                    <li wire:click="fetchEmployeeDetail({{ $record->code }})">
                                        {{ $record->code }} - {{ $record->bureau_d }}
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
                        <label for="Arrandissement" class="form-label">Arrondissment:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="" id="Arrond" name="arrondissement"
                                wire:model="search_arrondissement" wire:keyup="searchResult1">
                            @if($showdiv_arrondissement)
                            <div class="search-box" style="position:absolute;top:100%;left:0;">
                                <ul>
                                    @if(!empty($records_arrondissement))
                                    @foreach($records_arrondissement as $x)
                                    <li wire:click="fetchEmployeeDetail1({{ $x->code_a }})">
                                        {{ $x->code_b }} - {{ $x->intitule_a }}
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
                        <label for="Bureau_destination" class="form-label">Bureau destination:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="" id="Bureau_destination"
                                name="bureau_destination" wire:model="search_dest" wire:keyup="searchDest">
                            @if($showdiv_dest)
                            <div class="search-box" style="position:absolute;top:100%;left:0;">
                                <ul>
                                    @if(!empty($records_dest))
                                    @foreach($records_dest as $d)
                                    <li wire:click="fetchDest({{ $d->code_stockage }})">
                                        {{ $d->code_stockage }} - {{ $d->intitule_designation }}
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
                        <label for="Regime" class="form-label">Regime:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="" id="Regime" name="regime"
                                wire:model="search_regime" wire:keyup="searchRegime">
                            @if($showdiv_regime)
                            <div class="search-box" style="position:absolute;top:100%;left:0;">
                                <ul>
                                    @if(!empty($records_regime))
                                    @foreach($records_regime as $r)
                                    <li wire:click="fetchRecord({{ "'$r->Code_Regime'" }})">
                                        {{ $r->Code_Regime }} - {{ $r->Intitule_Regime }}
                                    </li>
                                    @endforeach

                                    @endif
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-row container mr-4">
                <div class="form-group col ">
                    <label for="N_serie" class="form-label">N° Série:</label>
                    <input type="text" class="form-control" value="" id="N_serie" name="n_serie" wire:model="serie"
                        wire:change="updateNumDum">
                </div>
                <div class="form-group col ">
                    <label for="Lettre" class="form-label">Lettre:</label>
                    <input type="text" class="form-control" value="" id="Lettre" name="lettre" wire:model="lettre"
                        wire:change="updateNumDum">
                </div>
                <div class="form-group col ">
                    <label for="Repertoire" class="form-label">Répertoire:</label>
                    <input type="text" class="form-control" value="" id="Repertoire" name="repertoire">
                </div>

            </div>
            <div class="form-row container">
                <div class="form-group col-md ">
                    <label for="Date_debut" class="form-label">Date Début:</label>
                    <input type="date" class="form-control" id="Date_debut" name="date_debut">
                </div>
                <div class="form-group col-md ">
                    <label for="Date_fin" class="form-label">Date Fin:</label>
                    <input type="date" class="form-control" id="Date_fin" name="date_fin">
                </div>

                <div class="form-group col-md">
                    <label for="Declaration" class="form-label">Declaration:</label>
                    <div class="input-group">
                        <select id="Declaration" name="declaration" class="form-control">
                            <option value="definitive">Definitive</option>
                            <option value="provisoire">Provisoire</option>

                        </select>
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="Devise" class="form-label">Devise:</label>
                    <select class="form-control" id="Devise" wire:model="selectedDevise" name="devise">
                        <option value="">Select Devise</option>
                        @foreach ($devise as $dv)
                        <option value="{{ $dv->Code_Devise }}">{{ $dv->Intitule_Devise }} ({{ $dv->Code_Devise }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md">
                    <label for="Cours" class="form-label">Cours:</label>
                    <input type="text" class="form-control" id="Cours" wire:model="cours" readonly>
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
                            wire:model="search_raison" wire:keyup="searchResultR">
                        @if($showdiv_raison)

                        <div class="search-box" style="position:absolute;top:100%;left:0;">

                            <ul>
                                @if(!empty($records_raison))
                                @foreach($records_raison as $record)
                                <li wire:click="fetchRaisonDetail({{ $record->Id }})">{{ $record->Raison_Sociale }}</li>
                                @endforeach
                                @endif
                            </ul>
                        </div>

                        @endif
                    </div>

                </div>
                <div class="form-group col-md-3">
                    <label for="Code_client" class="form-label">Code Client:</label>
                    <input type="text" id="Code_client" name="Code_Tiers" class="form-control" wire:model="Code_Tiers">
                </div>

                <div class="form-group col-md-3">
                    <label for="Adresse" class="form-label">Adresse:</label>
                    <input type="text" id="Adresse" name="Adresse" class="form-control" wire:model="Adresse">
                </div>
                <div class="form-group col-md-3">
                    <label for="Ville" class="form-label">Ville:</label>
                    <input type="text" id="Ville" name="Ville" class="form-control" wire:model="Ville">
                </div>


            </div>
            <br>
            <div class="form-row container justify-content-center mr-4 " style="margin-bottom: 2% ">

                <button type="submit" class="btn btn-success mybtn"><i class="fas fa-check">&nbsp; Valider</i></button>
                &nbsp;&nbsp;&nbsp;
                <button id="mybtn_supprimer" class="btn btn-danger mybtn"><i
                        class="fas fa-trash-alt"></i>&nbsp;Delete</button>
                &nbsp;&nbsp;&nbsp;

                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-dark mybtn"><i class="fas fa-undo"></i> Retour</button>
                </a>
                &nbsp;&nbsp;&nbsp;
            </div>
        </form>
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
        width: 68%;
    }

    .input-group {
        position: relative;
    }

    .input-group-append {
        position: absolute;
        top: 0;
        right: 0;
    }

    .form-control {
        border: none;
        border-bottom: 1px solid #5c5c59;
        padding: 3px 7px;
        line-height: normal;
        /* background-color: #eeeeee; */
        box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
        /* Increase the bottom margin */
    }

    .form-group .form-label {
        font-size: 14px;
    }

    .card-header {
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    a {
        color: black !important;
    }
</style>
