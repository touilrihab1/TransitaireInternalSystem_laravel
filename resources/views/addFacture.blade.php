@extends('layouts.admin')

@section('formule')
<!---------------------------------modifier id de table des articles---------------------->

<!doctype html>
<html>

<head>
    <title>formulaire Dossier </title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        #add {
            margin-bottom: 10px;
            margin-right: 10px;
        }
    </style>
    @livewireStyles
</head>

<body>
    <div class="container">
        <div class="card">
            @livewire('add-line-article', ['id1' => $id1, 'dossier' => $dossier])
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/style.js"></script>
    @livewireScripts

</body>

</html>
@endsection
