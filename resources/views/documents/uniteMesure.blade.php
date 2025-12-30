@extends('layouts.admin')
@section('formule')

<link rel="stylesheet" href="css/style.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

<style>
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
        /* Add padding to the table container */
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
</style>

<div class="card">
    <br>
    <div class="card-header">
        Unité Mesure
    </div>
    <hr>
    <div class="card-body">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
        @endif

        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session::get('error') }}
        </div>
        @endif

        <div class="table-responsive">
            <button class="btn btn-dark" data-toggle="modal" data-target="#UniteModal">
                <i class="fas fa-plus"></i> Aajouter Unité
            </button>
            <table class="table table-hover mt-2" style="width: 90%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code Mesure</th>
                        <th>Intitulé Mesure</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unite_mesure as $unit)
                    <tr>
                        <td>{{ $unit->Id_Unite_Mesure }}</td>
                        <td>{{ $unit->Code_Unite }}</td>
                        <td>{{ $unit->Intitule_Unite }}</td>

                        <td> <button type="submit" class="btn  " data-toggle="modal" data-target="#deleteModal"
                                onclick="getid1({{ $unit->Id_Unite_Mesure }})"><i class="fas fa-trash-alt"
                                    style="color: #b71515 !important;"></i></button></td>
                        <td> <button type="submit" class="btn  " data-toggle="modal" data-target="#ModifierUniteModal"
                                onclick="getid2({{ $unit->Id_Unite_Mesure }})"><i class="fas fa-edit"
                                    style="color: #115a17 !important;"></i></button></td>

                    </tr>


                    @endforeach
                </tbody>
            </table>
            {!! $unite_mesure->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    <div id="modals">

        <div class="modal fade" id="UniteModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Ajouter Unité</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action='/save/unite' method="POST">
                            @csrf
                            <style>
                                a {
                                    color: #1a1a1a !important;
                                }
                            </style>

                            <div class="form-group">
                                <label for="codeUnite" class="form-label">code Unité de Mesure:</label>
                                <input type="text" name="codeUnite" class="form-control" placeholder="Enter Value">
                            </div>
                            <div class="form-group">
                                <label for="intituleunite" class="form-label">Intitulé Unité:</label>
                                <input type="text" name="intituleunite" class="form-control" placeholder="Enter Value">
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modals1">

        <div class="modal fade" id="ModifierUniteModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Modifier Unité Mesure</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action='/modifier/unite' method="POST">
                            @csrf
                            <style>
                                a {
                                    color: #1a1a1a !important;
                                }
                            </style>
                            <input id="newId2" name="newId2" hidden>
                            <div class="form-group">
                                <label for="codeUnite" class="form-label">code Unité de Mesure:</label>
                                <input type="text" name="codeUnite" class="form-control" placeholder="Enter Value">
                            </div>
                            <div class="form-group">
                                <label for="intituleunite" class="form-label">Intitulé Unité:</label>
                                <input type="text" name="intituleunite" class="form-control" placeholder="Enter Value">
                            </div>


                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/style.js"></script>
<script>
    function getid1(id)
 {
    const newId1 = document.getElementById('newId1');
    newId1.value = id ;
 }
         function getid2(id)
 {
    const newId2 = document.getElementById('newId2');
    newId2.value = id ;
 }
</script>
@endsection
