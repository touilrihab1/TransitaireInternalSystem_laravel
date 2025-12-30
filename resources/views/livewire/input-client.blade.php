<div class="form-row">
    <div class="col">
        <div class="form-group">
            <label for="Expedition" class="form-label">{{ $inputName }}</label>
            <input type="text" class="form-control" name="{{ $inputName }}" id="expedition" wire:model="search"
                wire:keyup="searchClient">
            @if($showdiv)

            <div class="search-box" style="position:absolute;top:100%;left:0;">

                <ul>
                    @if(!empty($records))
                    @foreach($records as $record)
                    <li wire:click="fetchClinetDetail({{ $record->Id }})">{{ $record->Raison_Sociale }}</li>
                    @endforeach
                    @endif
                </ul>
            </div>

            @endif
        </div>
    </div>

    <div class="col">
        <div class="form-group ">

            <label for="Destinataire" class="form-label">Destinataire</label>
            <input type="text" class="form-control" id="Destinataire" name="destinataire" wire:model="search_D"
                wire:keyup="searchD">
            @if($showdiv_D)

            <div class="search-box" style="position:absolute;top:100%;left:0;">

                <ul>
                    @if(!empty($records_D))
                    @foreach($records_D as $record)
                    <li wire:click="fetchDDetail({{ $record->Id }})">{{ $record->Raison_Sociale }}
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>

            @endif
        </div>
    </div>
    <div class="col">
        <div class="form-group ">

            <label for="Client_facturation" class="form-label">Client de facturation</label>
            <input type="text" class="form-control" id="Client_facturation" name="client_facturation">

        </div>

    </div>
    <div class="col">
        <div class="form-group ">

            <label for="Provenance" class="form-label">Destination</label>
            <input type="text" class="form-control" id="Provenance" name="provenance" wire:model="search_Dest"
                wire:keyup="searchDest">
            @if($showdiv_Dest)

            <div class="search-box" style="position:absolute;top:100%;left:0;">

                <ul>
                    @if(!empty($records_Dest))
                    @foreach($records_Dest as $record)
                    <li wire:click="fetchDestDetail({{ $record->Id_Origine }})">{{ $record->Intitule_Origine }}
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>

            @endif
        </div>
    </div>
    <div class="col">
        <div class="form-group ">
            <label for="Design_marchandise" class="form-label"
                style="display: inline-block; vertical-align: middle;">Désignation
                Marchandise</label>
            <input type="text" class="form-control" id="Design_marchandise" name="design_marchandise"
                style="display: inline-block;" wire:model="search_March" wire:keyup="searchMarch">
            @if($showdiv_March)

            <div class="search-box" style="position:absolute;top:100%;left:0;">

                <ul>
                    @if(!empty($records_March))
                    @foreach($records_March as $record)
                    <li wire:click="fetchMarchDetail({{ $record->Id_Article }})">{{ $record->Designation_Article }}
                    </li>
                    @endforeach
                    @endif
                </ul>
            </div>

            @endif
        </div>
    </div>
    <div class="col">
        <div class="form-group ">
            <label for="Transporteur" class="form-label">Transporteur</label>
            <input type="text" class="form-control" id="Transporteur" name="transporteur">
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
