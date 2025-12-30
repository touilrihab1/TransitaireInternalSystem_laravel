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
        Nomenclature
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
            <table class="table table-hover mt-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>@sortablelink('Code_Nomenclature', 'Code Nomenclature')</th>
                        <th>@sortablelink('Intitule_Nomenclature', 'Intitulé Nomenclature')</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($nomenclature as $nm)
                    <tr>
                        <td>{{ $nm->Id_Nomenclature }}</td>
                        <td>{{ $nm->Code_Nomenclature }}</td>
                        <td>{{ $nm->Intitule_Nomenclature }}</td>
                        <td>
                        </td>
                        <td>
                            <form action="{{ url('documents/nomenclature') }}" method="POST">
                                @csrf
                                <input value="{{ $nm->Id_Nomenclature }}" name="idn" hidden>
                                <button type="submit" class="btn btn-danger"
                                    style="background-color: #e11d48">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal -->

                    @endforeach
                    {{-- <div class="d-flex justify-content-center">
                        {{ $origine->links() }}
                    </div> --}}
                </tbody>


            </table>
            <br>

            {!! $nomenclature->withQueryString()->links('pagination::bootstrap-5') !!}


        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/style.js"></script>
@endsection
