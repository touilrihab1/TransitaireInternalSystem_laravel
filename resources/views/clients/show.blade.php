<div class="modal-header">
    <h5 class="modal-title" id="clientModalLabel">Client Information</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $user->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $user->email }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Roles:</strong>
                @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach


            @endif
        </div>
        <div class="form-group">
          
             <div>
                 <p><strong>Code Tiers: </strong> {{ $user->Code_Tiers }}</p>
             </div>
             <div>
                 <p><strong>Raison Sociale: </strong> {{ $user->Raison_Sociale }}</p>
             </div>
             <div>
                 <p><strong>Adresse: </strong> {{ $user->Adresse }}</p>
             </div>
             <div>
                 <p><strong>Telephone: </strong> {{ $user->Tel1 }}</p>
             </div>
           
          
 
         </div>
    </div>
     <div class="col-xs-12 col-sm-12 col-md-12">
   
       
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
