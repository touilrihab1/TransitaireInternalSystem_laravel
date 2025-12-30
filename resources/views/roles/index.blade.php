@extends('layouts.admin')

@section('formule')
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
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .table {
        margin-bottom: 20px;
        width: 70%;
        margin-left: 6%;
    }

    /* Apply styles to alternate rows */
    .table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* Hover effect */
    .table tr:hover {
        background-color: #f1ecec;
    }

    /* Adjust button margin */
    .pull-right.ml-5 a {
        margin-right: 5px;
    }
</style>


<div class="container">
    <br>
    <div class="card">
        <br>
        <div class="card-header">
            Role Management
        </div>
        <br>
        <div class="pull-right ml-5">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a class="btn btn-dark" href="{{ route('roles.create') }}"><i class="fas fa-plus-circle"
                    style="color: #ffffff !important;"> &nbsp;Add New Role</i>
            </a>
        </div>
        <br>
        @if ($message = Session::get('success'))
        <div class="alert alert-dark alert-dismissible fade show my-2 ml-5" role="alert"
            style="height: auto; max-height: 80px; width:40%">
            <p class="mb-0">{{ $message }}</p>
        </div>

        <style>
            .alert {
                padding: 0.5rem 1rem;
                font-size: 14px;
            }
        </style>

        <script>
            // Auto-dismiss the success message after 5 seconds
            setTimeout(function() {
                $(".alert").alert('close');
            }, 5000);
        </script>
        @endif
        <br>
        <table class="table table-bordered" style="width: 70%; margin-left:6%">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Voir</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <button class="btn btn-link btn-show" data-toggle="modal" data-target="#roleModal{{ $role->id }}">
                        <i class="fas fa-eye" style="color: #ffc107 !important;"></i>
                    </button>
                </td>
                <td>
                    <a class="btn" href="{{ route('roles.edit', $role->id) }}"><i class="fas fa-edit"
                            style="color: #115a17 !important;"></i></a>
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' =>
                    'display:inline']) !!}
                    <button type="submit" class="btn"
                        style="color: #b71515 !important; background-color: transparent !important; border-color: transparent !important;">
                        <i class="fas fa-trash-alt" style="color: #b71515 !important;"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
            <div id="modals">
                @foreach ($roles as $role)
                <div class="modal fade" id="roleModal{{ $role->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="roleModalLabel{{ $role->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            @include('roles.show', ['role' => $role, 'rolePermissions' => $rolePermissions[$role->id]??[]]) </div>
                    </div>
                </div>
                @endforeach
            </div>
        </table>
        {!! $roles->render() !!}
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <br>
    <br>
    <br>
</div>



@endsection
