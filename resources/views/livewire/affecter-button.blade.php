<link rel="stylesheet" href="css/style.css">
<div>
    <form action="{{ route('affecterGetId') }}" method="GET">
        <input type="hidden" name="id1" value="{{$idaze}}">
        @csrf
        <div class="affect ml-4">

            {{-- <button type="button" class="btn btn-success mybtn" data-toggle="modal" data-target="#myModal"><i
                    class="fas fa-paper-plane"></i> Affecter</button> --}}
            <!-- Button trigger modal -->
            <button type="button" data-toggle="modal" wire:click="affecterGetId" data-id="{{ $idaze }}"
                data-target="#confirmationModal{{ self::$count }}"><i class="fas fa-share-square"
                    style="color: #0e0d0c !important;"></i></button>


        </div>
        <br>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmationModal{{ self::$count }}" tabindex="-1" role="dialog"
    aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirmation de l'affectation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir affecter ce dossier ?
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <form action="{{url('/affecter')}}" method="POST">
                    @csrf
                    <input type="hidden" name="ida" value="{{$idaze}}">
                    <div class="form-group">
                        <label for="departement">Département(s) :</label>
                        <select name="departement[]" multiple class="form-control" id="departement">
                            @foreach($departements as $departement)
                            <option value="{{$departement->id}}">{{$departement->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="departement">observation :</label>
                        <input type="text" name="observation">
                    </div>
                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">
                        <i class="far fa-times-circle"></i> Annuler
                    </button>
                    <button type="submit" class="btn btn-info mybtn mr-3">
                        <i class="fas fa-share-square"></i> Affecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Form -->
