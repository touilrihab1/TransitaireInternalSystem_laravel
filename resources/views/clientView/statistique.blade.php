@extends('clientView.home')
@section('formuleClient')

<head>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:wght@200;300;400;500&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Kodchasan:ital,wght@0,300;1,200;1,300&family=Montserrat:ital,wght@0,200;0,300;0,800;1,200;1,300;1,400;1,500;1,600;1,700&family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&family=Parisienne&family=Playball&family=Poppins:ital,wght@0,100;0,200;0,300;0,800;0,900;1,100;1,200;1,300&family=Roboto+Condensed:wght@300;400;700&family=Roboto+Mono:ital,wght@0,100;1,100&family=Roboto:ital,wght@0,100;0,300;1,100&family=Rubik+Beastly&family=Teko:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">

    <style type="text/css">
        /* body{
        font-family: 'Roboto Mono', monospace;
    } */
        h1 {
            text-align: center;
            font-size: 35px;
            font-weight: 900;
        }

        .grey-bg {
            background-color: #F5F7FA;
        }

        .card-ce {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
        }

        .container {
            width: 90% !important;
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
        .container {
            width: 95% !important;
            max-width: 95% !important;
        }


    </style>
</head>


<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Tableau du bord</h1>
        </div>

        <div class="card-body">

            <section id="minimal-statistics">
                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card-ce">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-pencil primary font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{$dossier_dedouanmement}}</h3>
                                            <span>Dossier Passer Dédouanement</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card-ce">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-speech warning font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>{{$facture}}</h3>
                                            <span>Facture Non Payé</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card-ce">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-graph success font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>1</h3>
                                            <span>Nombre dossier</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card-ce">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="align-self-center">
                                            <i class="icon-pointer danger font-large-2 float-left"></i>
                                        </div>
                                        <div class="media-body text-right">
                                            <h3>1</h3>
                                            <span>Demande service</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="stats-subtitle">
                <div class="container">
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <canvas id="myChart" height="100px"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <canvas id="pieChart" width="70px" height=""></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <br><br><br><br><br><br><br><br>
    </div>
   
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var data1 = {
            labels: {!! json_encode($labels1) !!},
            datasets: [{
                data: {!! json_encode($values1) !!},
                backgroundColor: {!! json_encode($colors1) !!}
            }]
        };


        var ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: data1,

        });
    });
</script>

<script type="text/javascript">
    var labels =  {{ Js::from($labels) }};
    var users =  {{ Js::from($data) }};

    const data = {
        labels: labels,
        datasets: [{
            label: 'vos dossier créer par mois',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: users,
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {}
    };

    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );

</script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection
