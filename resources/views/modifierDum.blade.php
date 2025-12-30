
@extends('layouts.admin')
@section('formule')

<head>


    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
    <style>
        a {
            color: black !important;
        }

        .container {
            width: 95% !important;
            max-width: 95% !important;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            /* Add padding to the card */
        }
    </style>
</head>


<body>
    <div class="container">
        <div class="card">
            <br>

            @livewire('modifier-dum',['dum' => $dum ])


        </div>
        @livewireScripts
</body>
@endsection
