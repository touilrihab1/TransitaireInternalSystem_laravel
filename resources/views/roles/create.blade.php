@extends('layouts.admin')

@section('formule')
<br>
<style>
    .container {
        width: 95% !important;
        max-width: 100% !important;
    }

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
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    Create New Role
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
            {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
            <div class="row">
                <div class=" col-md-5">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br />
                        @foreach($permission as $value)
                        <label class="form-check-label">
                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input'))
                            }}
                            {{ $value->name }}
                        </label>
                        <br />
                        @endforeach
                    </div>
                </div>
                <br>

                <br>
                <div class=" text-left">
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-dark">Submit</button>
                </div>
            </div>
            {!! Form::close() !!}
            <br>
            <br>
            <br>
            <br>
        </div>
    </div>
    @endsection
