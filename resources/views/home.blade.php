@extends('layouts.admin')

@section('formule')

<head>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:wght@200;300;400;500&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Kodchasan:ital,wght@0,300;1,200;1,300&family=Montserrat:ital,wght@0,200;0,300;0,800;1,200;1,300;1,400;1,500;1,600;1,700&family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Parisienne&family=Playball&family=Poppins:ital,wght@0,100;0,200;0,300;0,800;0,900;1,100;1,200;1,300&family=Roboto+Condensed:wght@300;400;700&family=Roboto+Mono:ital,wght@0,100;1,100&family=Roboto:ital,wght@0,100;0,300;1,100&family=Rubik+Beastly&family=Teko:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
</head>
<style>
    body {
        overflow-x: auto;
    }

    h1 {
        text-align: center;
        font-size: 35px;
        font-weight: 900;
    }

    .container {
        width: 100% !important;
        max-width: 100% !important;
        overflow-x: auto;
    }

    .card-title {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .card-body {
        text-align: center;
    }

    .card-link {
        color: #007bff;
        text-decoration: none;
    }

    .card-link:hover {
        text-decoration: none;
        color: #007bff;
    }

    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        margin: 10px;
        margin-bottom: 10px;
        background-color: #fff;
        width: 90% !important;
    }


    .card-header {
        font-size: 15px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .d {
        box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px;
        width: 79% !important;
    }


    .facture {
        box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

    .test {
        display: flex;
        align-items: center;
        padding: 0 10px;
        justify-content: center;
        height: 30%;
    }

    .wrapper {
        width: 548px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .wrapper1 {
        width: 548px;
        height: 480px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    .wrapper header {
        display: flex;
        align-items: center;
        padding: 25px 30px 10px;
        justify-content: space-between;
    }

    .header1 .icons {
        display: flex;
    }

    .header1 .icons span {
        height: 38px;
        width: 38px;
        margin: 0 1px;
        cursor: pointer;
        color: #878787;
        text-align: center;
        line-height: 38px;
        font-size: 1.9rem;
        user-select: none;
        border-radius: 50%;
    }

    .icons span:last-child {
        margin-right: -10px;
    }

    .header1 .icons span:hover {
        background: #f2f2f2;
    }

    .header1 .current-date {
        font-size: 1.45rem;
        font-weight: 500;
    }

    .calendar {
        padding: 20px;
    }

    .calendar ul {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
        text-align: center;
    }

    .calendar .days {
        margin-bottom: 20px;
    }

    .calendar li {
        color: #333;
        width: calc(100% / 7);
        font-size: 1.07rem;
    }

    .calendar .weeks li {
        font-weight: 500;
        cursor: default;
    }

    .calendar .days li {
        z-index: 1;
        cursor: pointer;
        position: relative;
        margin-top: 30px;
    }

    .days li.inactive {
        color: #aaa;
    }

    .days li.active {
        color: #fff;
    }

    .days li::before {
        position: absolute;
        content: "";
        left: 50%;
        top: 50%;
        height: 40px;
        width: 40px;
        z-index: -1;
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

    .days li.active::before {
        background: #BF4969;
    }

    .days li:not(.active):hover::before {
        background: #f2f2f2;
    }

    .table-card {
        box-shadow: 0 19px 38px rgba(0, 0, 0, 0.30), 0 15px 12px rgba(0, 0, 0, 0.22);
    }

    .text-primary {
        color: blue;
    }

    .text-success {
        color: green;
    }
</style>

<body>


    <br>
    <div class="container">

        <div class="card">


            <div class="card-header">Dashboard</div>
            @if(auth()->user()->hasRole('Admin'))
            <div class="row">
                <div class="col">
                    <div class="card border-primary table-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="#" class="card-link"><i
                                        class="fas fa-tasks fa-2x text-dark"></i>&nbsp;&nbsp;Nombre
                                    d'opérations aujourd'hui:</a>
                            </h5>
                            <div class="mt-3"><strong>{{$nbr_operation}}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-success table-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="#" class="card-link"><i
                                        class="fas fa-users fa-2x text-success"></i>&nbsp;&nbsp;Nombre
                                    Compte Client:</a>
                            </h5>
                            <div class="mt-3"><strong>{{$client}}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card border-info table-card">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="#" class="card-link"><i
                                        class="fas fa-user fa-2x text-info"></i>&nbsp;&nbsp;Nombre
                                    Opérateur:</a>
                            </h5>
                            <div class="mt-3"><strong>{{$operateur}}</strong></div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(auth()->user()->hasRole('dédouanement'))

            <div class="row">
                <div class="col">
                    <div class="card d">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#" class="card-link">
                                    <i class="fas fa-check-circle fa-2x text-dark"></i> &nbsp;&nbsp;dossier
                                    affécter aujourdhui:
                                </a>
                            </h4>
                            <div class="mt-3"><strong>{{$dossier_ded}}</strong></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card d">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#" class="card-link">
                                    <i class="fas fa-check-circle fa-2x text-secondary"></i>
                                    &nbsp;&nbsp;dossier déclaré:
                                </a>
                            </h4>
                            <div class="mt-3"><strong>{{$dossier_declare}}</strong></div>
                            <a href="#" class="card-link"></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card d">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#" class="card-link">
                                    <i class="fas fa-exclamation-circle fa-2x text-warning"></i> &nbsp;&nbsp;dossier
                                    incomplet:
                                </a>
                            </h4>
                            <div class="mt-3"><strong>{{$dossier_declare}}</strong></div>
                            <a href="#" class="card-link"></a>
                        </div>
                    </div>
                </div>
            </div>




            <div class="row">
                <div class="test col-xl-5 col-md-11 mt-2">
                    <div class="card table-card wrapper1">
                        <div class="card-header">
                            <h5>Cours de Change</h5>
                        </div>
                        <div class="card-block">
                            <div class="table-responsive">
                           
                                <table class="table table-hover table-borderless">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Country</th>
                                            <th>Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span class="flag-icon flag-icon-eu"></span></td>
                                            <td>Euro</td>

                                            <td>10.9769</td>

                                        </tr>
                                        <tr>
                                            <td><span class="flag-icon flag-icon-us"></span></td>
                                            <td>Dollar</td>
                                            <td>10.3064</td>
                                        </tr>
                                        <tr>
                                            <td><span class="flag-icon flag-icon-kw"></span></td>
                                            <td>Dirham Kuwait</td>
                                            <td>32.2070</td>
                                        </tr>
                                        <tr>
                                            <td><span class="flag-icon flag-icon-gb"></span></td>
                                            <td>United Kingdom</td>
                                            <td>12.7770</td>
                                        </tr>
                                        <tr>
                                            <td><span class="flag-icon flag-icon-ch"></span></td>
                                            <td>Franc Suisse</td>
                                            <td>11.15</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                &nbsp; &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;
                &nbsp;

            @endif


            @if(auth()->user()->hasRole('facturation'))
            <div class="row">
                <!-- Facture payée card -->
                <div class="col">
                    <div class="card facture">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="#" class="card-link"><i
                                        class="fas fa-check-circle fa-2x text-primary"></i>&nbsp;&nbsp;Facture
                                    payée:</a>
                            </h5>
                            <div class="mt-3"><strong>{{$facture_paye}}</strong></div>
                            <a href="#" class="card-link">Voir Détails</a>
                        </div>
                    </div>
                </div>
                <!-- Facture non payée card -->
                <div class="col">
                    <div class="card facture">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="#" class="card-link"><i
                                        class="fas fa-exclamation-circle fa-2x text-danger"></i>&nbsp;&nbsp;Facture non
                                    payée:</a>
                            </h5>
                            <div class="mt-3"><strong>{{$facture_non_paye}}</strong></div>
                            <a href="#" class="card-link">Voir Détails</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dossiers Affectés table -->
            <div class="table-responsive mt-4">
                <h4>Dossiers Affectés</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>N° Dum</th>
                            <th>N° Dossier</th>
                            <th>Date Dossier</th>
                            <th>Navire</th>
                            <th>Matricule</th>
                            <th>Date d'arrivée</th>
                            <th>Expéditeur</th>
                            <th>Poids Brut</th>
                            <th>Poids Net</th>
                            <th>Nombre de colis</th>
                            <th>Intitulé Marchandises</th>
                            <th>Voir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dossiers as $dossier)
                        <tr>
                            <td>{{ $dossier->num_dum}}</td>
                            <td>{{ $dossier->n_dossier}}</td>
                            <td>{{ $dossier->date_dossier }}</td>
                            <td>{{ $dossier->navire }}</td>
                            <td>{{ $dossier->n_moyen }}</td>
                            <td>{{ $dossier->date_arrive }}</td>
                            <td>{{ $dossier->expediteur }}</td>
                            <td>{{ $dossier->poids_brut }}</td>
                            <td>{{ $dossier->poids_net }}</td>
                            <td>{{ $dossier->n_colis }}</td>
                            <td>{{ $dossier->designation_marchandise }}</td>
                            <td>
                                <form action="{{url('/dossier/voir')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id1" value="{{Crypt::encrypt($dossier->id) }}">
                                    <button type="submit" class="btn btn-info"><i class="far fa-eye"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif


            @if(auth()->user()->hasRole('exploitation'))
            <div class="row">
                <div class="col">
                    <div class="card d">
                        <div class="card-body">
                            <h4 class="card-title"><i class="fas fa-folder-open fa-2x text-dark"><a href="#"
                                        class="card-link"></i>&nbsp;&nbsp;Dossiers Créés:
                            </h4>

              
                           <div class="mt-3"><strong>{{$nbr_dossier}}</strong></div> 

                            <a href="{{ url('/tableDossier') }}" class="card-link"> Voir Details</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card d">
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="#" class="card-link"><i
                                        class="fas fa-exclamation-circle fa-2x text-secondary"></i>&nbsp;&nbsp;Dossiers
                                    Incomplets:
                            </h4>
                            <div class="mt-3"><strong>{{$nbr_incomplet}}</strong></div>
                            {{-- <a href="#" class="card-link">Voir Details</a> --}}

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card d">
                        <div class="card-body">
                            <h4 class="card-title"><a href="#" class="card-link"><i
                                        class="fas fa-check-circle fa-2x text-warning"></i>&nbsp;&nbsp;Dossiers
                                    clôturés:</h4>

                            <div class="mt-3"><strong>{{$nbr_cloture}}</strong></div>
                            {{-- <a href="#" class="card-link">Voir Details</a> --}}
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="card-body ml-4 " style="width: 80% !important;">
                <canvas id="myChart" height="100px"></canvas>
            </div>


            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            @if(!auth()->user()->hasRole('dédouanement') && !auth()->user()->hasRole('facturation'))
            <script type="text/javascript">
                var labels = {!! json_encode($labels) !!};
    var data = {!! json_encode($data) !!};

    const config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: ' dossiers créés',
                backgroundColor: '#952429',
                borderColor: '#952429',
                data: data,
            }]
        },
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
            </script>
            @endif
         


        </div>
        <br>
        <br>
    </div>
</body>
@endsection
