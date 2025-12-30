@extends('layouts.admin')
@section('formule')



<head>
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

        .search-bar {
            margin-bottom: 20px;
        }

        a {
            color: black !important;

        }

        .delete-button {
            color: red;
        }
    </style>
</head>
<div class="card">
    br
    <div class="card-header">
        Articles
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

        <div class="search-bar d-flex justify-content-between align-items-center">
            <div>
                <button class="btn btn-dark" data-toggle="modal" data-target="#ArticleModal">
                    <i class="fas fa-plus"></i>ajouter article
                </button>
            </div>

            <form action="{{ route('article.search') }}" method="GET" class="flex-grow-1">
                <div class="input-group col-md-3">
                    <input type="text" class="form-control" name="search"
                        placeholder="Search by article code or designation">
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mt-2" style="width: 80%">
                <thead>
                    <tr>
                        <th>ID</th>
                        
                        <th>@sortablelink('Code_Article', 'Code Article')</th>
                        <th>@sortablelink('Designation_Article', 'Designation Article')</th>
                        <th>@sortablelink('Code_Nomencl', 'Code Nomenclature')</th>
                        
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($article as $arc)
                    <tr>
                        <td>{{ $arc->Id_Article }}</td>
                        <td>{{ $arc->Code_Article }}</td>
                        <td>{{ $arc->Designation_Article }}</td>
                        <td>{{ $arc->Code_Nomencl }}</td>
                        <td>
                        </td>
                        <td>

                            <button type="submit" class="btn  " data-toggle="modal" data-target="#deleteModal"
                                onclick="getid1({{ $arc->Id_Article }})"><i class="fas fa-trash-alt"
                                    style="color: #b71515 !important;"></i></button>
                        </td>
                        <td>

                            <button type="submit" class="btn " data-toggle="modal" data-target="#ModifierArticleModal"
                                onclick="getid({{ $arc->Id_Article }})"><i class="fas fa-edit"
                                    style="color: #115a17 !important;"></i></button>

                        </td>
                    </tr>
                    <!-- Modal -->
                    @endforeach
                </tbody>
            </table>
            {!! $article->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</div>
<div id="modals">

    <div class="modal fade" id="ArticleModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel"> <i class="fas fa-plus"></i>Ajouter Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action='/save/article' method="POST">
                        @csrf
                        <style>
                            a {
                                color: #1a1a1a !important;
                            }
                        </style>

                        <div class="form-group">
                            <label for="codeArticle" class="form-label">code article:</label>
                            <input type="text" name="codeArticle" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="designationArticle" class="form-label">designation article:</label>
                            <input type="text" name="designationArticle" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="codeNomenclature" class="form-label">code nomenclature:</label>
                            <input type="text" name="codeNomenclature" class="form-control" placeholder="Enter Value">
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

    <div class="modal fade" id="ModifierArticleModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Modifier Article</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action='/modifier/article' method="POST">
                        @csrf
                        <style>
                            a {
                                color: #1a1a1a !important;
                            }
                        </style>
                        <input name="ida" id="newId" hidden>
                        <div class="form-group">
                            <label for="codeArticle" class="form-label">code article:</label>
                            <input type="text" name="codeArticle" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="designationArticle" class="form-label">designation article:</label>
                            <input type="text" name="designationArticle" class="form-control" placeholder="Enter Value">
                        </div>
                        <div class="form-group">
                            <label for="codeNomenclature" class="form-label">code nomenclature:</label>
                            <input type="text" name="codeNomenclature" class="form-control" placeholder="Enter Value">
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
                <form action="{{ url('documents/article') }}" method="POST">
                    @csrf
                    <input name="ida1" id="newId1" hidden>
                    <button type="submit" class="btn btn-danger ">Yes, Delete</button>
                </form>

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
    function getid(id)
 {
    const newId = document.getElementById('newId');
    newId.value = id ;
 }
 function getid1(id)
 {
    const newId1 = document.getElementById('newId1');
    newId1.value = id ;
 }
</script>
@endsection
