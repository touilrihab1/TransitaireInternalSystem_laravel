@extends('layouts.admin')

@section('formule')

<br><br>



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
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    a {
        color: black !important;
    }
</style>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-10 margin-tb">
                <div class="pull-left">
                    Edit User
                </div>
            </div>
        </div>
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
        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' =>
                    'form-control')) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Permissions:</strong>
                    <br>
                    <table class="table" style="width:70%">
                        <tr>
                            @php $count = 0; @endphp
                            @foreach($permission as $value)
                            <td>
                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $userPermissions) ?
                                true :
                                false, array('class' => 'name')) }}
                                {{ $value->name }}
                            </td>
                            @php $count++; @endphp
                            @if($count % 5 === 0)
                        </tr>
                        <tr>
                            @endif
                            @endforeach
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="text-left">
            <button type="submit" class="btn btn-dark"><i class="fas fa-caret-down"></i>&nbsp;Submit</button>

        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection
