<br>
<br>

<div class="card-header">
    Voir utilisateur
</div>
<div class="card-body">
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
                @if (!empty($user->getRoleNames()))
                @foreach ($user->getRoleNames() as $v)
                <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach
                @endif
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if (!empty($permissions[$user->id]))
                @foreach ($permissions[$user->id] as $permission)
                <span class="badge rounded-pill bg-dark">{{ $permission->name }}</span>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
