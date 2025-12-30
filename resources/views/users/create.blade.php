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
        background-color: #fff;
    }

    .card-header {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    a {
        color: black !important;
    }
</style>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    Create New User
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
        {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}

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
                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                </div>
            </div>
        </div>
        <div class="col">
            <div class=" form-group">
                <strong>Permission:</strong>
                <br />
                <table class="table" style="width:30%">
                    @foreach($permission as $value)
                    <tr>
                        <td>
                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input'))
                            }}
                        </td>
                        <td>
                            {{ $value->name }}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-left">
                <button type="submit" class="btn btn-dark">Submit</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
