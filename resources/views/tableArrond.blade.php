@extends('layouts.admin')
@section('formule')
<title>les bureaux </title>
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

    .mybtn {
        background-color: #437bb8;
        color: #fff;
        border-radius: 5px;
        border: none;
        padding: 5px 10px;
    }
</style>
<div class="card">
    <br>
    <div class="card-header">
        Bureau Arrondissement
    </div>
    <hr>
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

    <div class="search-bar d-flex justify-content-between align-items-center">
        <div>
            <button class="btn btn-dark" data-toggle="modal" data-target="#ArrondissementModal">
                <i class="fas fa-plus"></i> Ajouter Arrondissement
            </button>
        </div>
        <form action="{{ route('arrond.search') }}" method="GET" class="flex-grow-1">
            <div class="input-group col-md-3">
                <input type="text" class="form-control" name="search" placeholder="Search by code">
                <div class="input-group-append">
                    <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
    <div class="d-flex">



        <div class="table-responsive">
            <table class="table table-hover mt-2  mr-2 " style="width: 90%">
                <thead>
                    <tr>
                        <th>@sortablelink('code_b', 'Code Bureau')</th>
                        <th>@sortablelink('intitule_b', 'Intitulé de Bureau douanier')</th>
                        <th>@sortablelink('code_a', 'code arrondissement')</th>
                        <th>@sortablelink('intitule_a', 'Intitulé de l`Arrondissement')</th>
                    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrondissement as $arrond)
                    <tr>

                        <td>{{ $arrond->code_b}}</td>
                        <td>{{ $arrond->intitule_b}}</td>
                        <td>{{ $arrond->code_a}}</td>
                        <td>{{ $arrond->intitule_a}}</td>
                        <td> <button type="submit" class="btn  " data-toggle="modal" data-target="#deleteModal"
                                onclick="getid1({{ $arrond->id }})"><i class="fas fa-trash-alt"
                                    style="color: #b71515 !important;"></i></button>
                        </td>
                        <td> <button type="submit" class="btn  " data-toggle="modal" data-target="#ModifierModal"
                                onclick="getid2({{ $arrond->id }})"><i class="fas fa-edit"
                                    style="color: #115a17 !important;"></i></button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
    {!! $arrondissement->withQueryString()->links('pagination::bootstrap-5') !!}
</div>
<div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                <form action="{{ url('delete/arrondissement') }}" method="POST">
                    @csrf
                    <input name="ido" id="newId1" hidden>
                    <button type="submit" class="btn btn-danger ">Yes, Delete</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div id="modals">

    <div class="modal fade" id="ArrondissementModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Ajouter Arrondissement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action='/save/arrondissement' method="POST">
                        @csrf
                        <style>
                            a {
                                color: #1a1a1a !important;
                            }
                        </style>

                        <div class="form-group">
                            <label for="codeBureau" class="form-label">code Bureau:</label>
                            <input type="text" name="codeBureau" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="bureauDouanier" class="form-label">Intitulé Bureau:</label>
                            <input type="text" name="bureauDouanier" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="codeArrondissement" class="form-label">code Arrondissement:</label>
                            <input type="text" name="codeArrondissement" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="intituleArrondissement" class="form-label">Intitulé Arrondissement:</label>
                            <input type="text" name="intituleArrondissement" class="form-control"
                                placeholder="Enter Value">
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
<div id="modals1">

    <div class="modal fade" id="ModifierModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Modifier Arrondissement</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action='/modifier/arrondissement' method="POST">
                        @csrf
                        <style>
                            a {
                                color: #1a1a1a !important;
                            }
                        </style>
                        <input type="text" id="newId2" name="newId2" hidden>
                        <div class="form-group">
                            <label for="codeBureau" class="form-label">code Bureau:</label>
                            <input type="text" name="codeBureau" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="bureauDouanier" class="form-label">Intitulé Bureau:</label>
                            <input type="text" name="bureauDouanier" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="codeArrondissement" class="form-label">code Arrondissement:</label>
                            <input type="text" name="codeArrondissement" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="intituleArrondissement" class="form-label">Intitulé Arrondissement:</label>
                            <input type="text" name="intituleArrondissement" class="form-control"
                                placeholder="Enter Value">
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
