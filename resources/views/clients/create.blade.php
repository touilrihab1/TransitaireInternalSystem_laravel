@extends('layouts.admin')

@section('formule')
<br>

<head>
    <link href="css/style.css" rel="stylesheet">
    <style>
        .container {
            width: 100% !important;
            height: 110% !important;
            max-width: 100% !important;
            max-height: 100% !important;
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
            width: auto !important;
            max-width: 110%;
        }

        .card-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
        }

        .card-body {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 18px;
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }

        .btn-primary {
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
        }

        a {
            color: black !important;
        }
    </style>
</head>

<div class="container">
    <div class="card">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <h2>Create New Client</h2>
                        </div>
                        <div class="col text-right">
                            <a class="btn btn-secondary" href="{{ route('clients.index') }}">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
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

                    {!! Form::open(array('route' => 'clients.store','method'=>'POST')) !!}

                    <div class="form-group">
                        <label for="name">Name:</label>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control'))
                        !!}
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm Password:</label>
                        {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' =>
                        'form-control')) !!}
                    </div>

                    <div class="form-group">
                        <label for="codeTiers">Code Tiers:</label>
                        {!! Form::text('codeTiers', null, array('placeholder' => 'Code Tiers','class' =>
                        'form-control')) !!}
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-check"></i> Submit
                        </button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <br><br><br>
    </div>
</div>

@endsection
