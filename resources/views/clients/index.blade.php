@extends('layouts.admin')

@section('formule')
<br>

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

<body>

    <div class="container">
        <br>
        <div class="card">
            <div class="card-header">
                Clients Management
            </div>
            <br>
            <div class="pull-right ml-5">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-dark" href="{{ route('clients.create') }}"><i class="fas fa-user"
                        style="color: #ffffff !important;"> &nbsp;Add Client</i>
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
                    <th>Email</th>
                    <th>Code Tiers</th>
                    <th>client</th>
                    <th>Voir</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                @foreach ($data as $key => $user)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{$user->Code_Tiers}}</td>
                    <td>{{$user->Raison_Sociale}}</td>
                    <td>

                        <button class="btn" data-toggle="modal" data-target="#clientModal{{ $user->id }}"><i
                                class="fas fa-eye" style="color: #ffc107 !important;"></i></button>

                    </td>
                    <td>
                        <a class="btn" href="{{ route('clients.edit',$user->id) }}"><i class="fas fa-edit"
                                style="color: #115a17 !important;"></i></a>
                    </td>
                    <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['clients.destroy',
                        $user->id],'style'=>'display:inline']) !!}
                        <button type="submit" class="btn"
                            style="color: #b71515 !important; background-color: transparent !important; border-color: transparent !important;">
                            <i class="fas fa-trash-alt" style="color: #b71515 !important;"></i>
                        </button> {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
                <div id="modals">
                    @foreach ($data as $key => $user)
                    <div class="modal fade" id="clientModal{{ $user->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="clientModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                @include('clients.show', ['user' => $user])
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </table>
            
            {{-- {!! $data->render() !!} --}}
            <br><br><br><br><br><br> <br><br><br>
            <br><br><br>
        </div>
    </div>
    @endsection