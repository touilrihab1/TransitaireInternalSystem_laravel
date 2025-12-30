<div>
    @if ($message = Session::get('success'))
    <div class="alert alert-dark alert-dismissible fade show my-2 ml-5" role="alert"
        style="height: auto; max-height: 80px; width:100%">
        <p class="mb-0">{{ $message }}</p>
    </div>

    <style>
        .alert {
            padding: 0.5rem 1rem;
            font-size: 14px;
        }
    </style>

    <script>
        // Auto-dismiss the success message after 5 seconds
                                                setTimeout(function() {
                                                    $(".alert").alert('close');
                                                }, 5000);
    </script>
    @endif
    <input type="hidden" name="id" value="{{$idaze}}">
    <table class="table" style="width: 80%">
        <thead>
            <tr>
               
                <th>charge Name</th>
                <th>valeur</th>
                <th>réference facture</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($charges as $charge)
            <tr>
                <td>{{ $charge->Designation_Charge }}</td>
                
              <td>{{ $charge->valeur }}DH</td>
              <td>{{$charge->serie_facture}}</td>
                <td>
                    
                    <button type="button" wire:click="deleteId({{ $charge->id }})" class="btn btn-danger"
                        data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-trash-alt">Delete</i></button>

                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                    <button type="button" wire:click.prevent="delete()" class="btn btn-danger close-modal"
                        data-dismiss="modal">Yes, Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
