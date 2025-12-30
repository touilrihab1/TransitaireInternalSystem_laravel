<br><br>

<div class="card-header">
    <h2> Show Role</h2>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions:</strong>
                @if (!empty($rolePermissions))
                @foreach ($rolePermissions as $p)
                <label class="label label-success">{{ $p->name }},</label>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
