@extends('layouts.admin')

@section('formule')
<br>
<style>
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
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    a {
        color: black !important;
    }
</style>
<div class="card">
    <div class="card-header">
        Edit Role
    </div>

    <div class="card-body">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-4">
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Permission</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permission as $value)
                        <tr>
                            <td>
                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ?
                                true : false, ['class' => 'name']) }}
                            </td>
                            <td>{{ $value->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-left">
            <button type="submit" class="btn btn-dark"><i class="fas fa-caret-down"></i>&nbsp;Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection
