@extends('layouts.admin')
@section('formule')
<title>formulaire Dossier </title>
<link rel="stylesheet" href="css/style.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
<style>
    {
        width: 80%;
        border-collapse: collapse;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        /* Add padding to the card */
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: none;
        font-weight: bold;
        padding-bottom: 10px;
        /* Add padding to the card header */
    }

    .table-responsive {
        padding: 10px 0;
    }

    .table {
        overflow-x: auto;
    }



    th,
    td {
        padding: 8px;
        /* Add padding to table cells */
    }

    tbody tr:nth-child(even) {
        background-color: #f8f9fa;
        /* Alternate row background color */
    }

    .mybtn {
        background-color: #437bb8;
        color: #fff;
        border-radius: 5px;
        border: none;
        padding: 5px 10px;
    }
</style>
<div class="card">
    <div class="table-responsive" style="overflow-y: auto;">
        <br>
        <div class=" d-flex">

            <a href="{{ url('/export_client') }}">
                <button type="button" class="btn btn-dark ml-3" style="color: white">
                    <i class="fas fa-file-download"> </i>&nbsp; Excel
                </button>
            </a>
            <a href="{{ url('/addClient') }}">
                <button type="button" class="btn btn-secondary ml-3" style="color: white">
                    <i class="fas fa-user-plus"> </i>Ajouter client
                </button>
            </a>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <form action="{{ route('searchClients') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search clients...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-dark "><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <table class="table table-hover  mt-2">
            <thead>
                <tr>
                    <th> Code Tiers</th>
                    <th>Raison Sociale</th>
                    <th>Adresse</th>
                    <th> Ville</th>
                    <th> Tel1</th>
                    <th>Fax</th>
                    <th>Email</th>

                    <th>Pays</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>
                    <td>{{ $client->Code_Tiers }}</td>
                    <td>{{ $client->Raison_Sociale}}</td>
                    <td>{{ $client->Adresse}}</td>
                    <td>{{ $client->Ville }}</td>
                    <td>{{ $client->Tel1 }}</td>
                    <td>{{ $client->Fax }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->Pays }}</td>

                    <a href="{{ url('/addClient') }}">
                        <td><button type="button" class="btn btn-dark "><i class="fas fa-pencil-alt"></i></button></td>
                    </a>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>


        {!! $clients->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>

    <br>
    <br>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/style.js"></script>
@endsection
