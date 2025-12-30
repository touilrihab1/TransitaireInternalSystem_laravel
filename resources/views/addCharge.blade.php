@extends('layouts.admin')

@section('formule')

<head>
    <link href="css/style.css" rel="stylesheet">
    @livewireStyles
    <style>
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin: 20px;
            margin-bottom: 10px;
            margin-left: 10px;
            /* Add a bottom margin of 10px */
            background-color: #fff;
        }

        .card-header {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="panel panel-primary ml-4">
            <div class="panel-body">


                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <br><br>
                <div class="col ">
                    <label for="Num_dossier">Numéro Dossier </label>
                    <input type="text" class="form-control col-md-4" value="{{$num}}" id="Num_dossier"
                        name="num_dossier" disabled>
                </div>
                <br><br>

               

                <form action='/save/charge' method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$idaze}}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="custom-file ml-4">
                                    <input class="custom-file-label" name="serie_facture" type="text"
                                        placeholder="Reference Facture">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <div class="custom-file ml-4">
                                    <input class="custom-file-label" name="valeur_charge" type="text"
                                        placeholder="valeur de charge en DH">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group mb-3">
                                <select name="type" class="custom-select" id="type" required>
                                    <option value="" selected disabled>Select Type</option>
                                    @foreach($charge as $key => $type)
                                    <option value="{{ $type->Id_Charge }}">{{ $type->Designation_Charge }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <label class="input-group-text" for="type"><i class="fas fa-folder"></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info btn-block"><i class="fas fa-upload"></i>
                                ajouter</button>
                        </div>
                    </div>
                </form>


            </div>


            @livewire('charge-list', ['idaze' => $idaze])


        </div>

        <br><br><br><br><br><br><br><br>
        &nbsp;&nbsp;&nbsp;
        {{-- <a href="" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back
        </a> --}}
    </div>

    </div>





    <script>
        const fileInput = document.getElementById("file-input");
        const fileLabel = document.querySelector(".custom-file-label");

        fileInput.addEventListener("change", function() {
          const fileName = this.value.split("\\").pop(); // get the file name without the path
          fileLabel.textContent = fileName || "Choose file"; // set the label to the file name or "Choose file"
        });
    </script>



    <style></style>
    @livewireScripts

</body>
@endsection
