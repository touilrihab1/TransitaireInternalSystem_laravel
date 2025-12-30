@extends('layouts.admin')

@section('formule')

<head>
    <title>Dossier</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card {
            width: 90%;
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin: 0 auto;
            margin-top: 50px;
            border-top: 4px solid #040405;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border-top: 1px solid #c4bfbf;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            vertical-align: middle;
            white-space: nowrap;
            border: 1px solid #c4bfbf;
        }

        th {
            font-weight: bold;
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: none;
            font-weight: bold;
            padding-bottom: 10px;
        }

        .mybtn {
            background-color: #437bb8;
            color: #fff;
            border-radius: 5px;
            border: none;
            padding: 5px 10px;
        }

        .mt-2 {
            margin-top: 20px;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a {
            color: black !important;
        }
    </style>
</head>
<div class="card">
    <div class="card-header">
        Traçabilité
    </div>
    <div class="card-body">
        <form action="{{ route('trace.search') }}" method="GET" class="search-form flex-grow-1"
            style="color: black  !important;">
            <div class="input-group ml-4">
                <style>
                    a {
                        color: black !important;
                    }
                </style>
                <input type="text" name="query" class="form-control col-md-2" placeholder="Recherche..."
                    style="background-color: white;">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
        <br>
        <table class="table table-hover mt-2" style="width: 90%">
            <thead>
                <tr>
                    <th>@sortablelink('id_user','N° operateur')</th>
                    <th>@sortablelink('user_name','Nom operateur')</th>
                    <th>@sortablelink('n_dossier','N° Dossier')</th>
                    <th>@sortablelink('permission_name','Action')</th>
                    <th>@sortablelink('date','created_at')</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach ($traces as $trace)
                <tr>
                    <td>{{ $trace->id_user }}</td>
                    <td>{{ $trace->user_name }}</td>
                    <td>{{ $trace->n_dossier }}</td>
                    <td>{{ $trace->tache}}</td>
                    <td>{{$trace->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br><br><br><br><br><br><br><br> <br><br><br><br><br> <br>
    <br><br><br><br><br> <br>
    <br>
</div>
@endsection
