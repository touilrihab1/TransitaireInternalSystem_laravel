<div>
    <div class="form-row container">
        <div class="form-group col-md-3">
            <label for="Raison_sociale">Raison Sociale:</label>
            <div class="input-group">
                <input type="text" id="Raison_sociale" name="Raison_sociale" class="form-control" wire:model="search" wire:keyup="searchResult">
                @if($showdiv)

                    <div class="search-box" style="position:absolute;top:100%;left:0;">

                        <ul>
                            @if(!empty($records))
                            @foreach($records as $record)
                            <li wire:click="fetchEmployeeDetail({{ $record->Id }})">{{ $record->Raison_Sociale }}</li>
                            @endforeach
                            @endif
                        </ul>
                    </div>

                @endif
            </div>

        </div>
        <div class="form-group col-md-3">
            <label for="Code_client">Code Client:</label>
            <input type="text" id="Code_client" name="Code_Tiers" class="form-control" wire:model="Code_Tiers">
        </div>

        <div class="form-group col-md-3">
            <label for="Adresse">Adresse:</label>
            <input type="text" id="Adresse" name="Adresse" class="form-control" wire:model="Adresse">
        </div>
        <div class="form-group col-md-3">
            <label for="Ville">Ville:</label>
            <input type="text" id="Ville" name="Ville" class="form-control" wire:model="Ville">
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
