<!DOCTYPE html>
<html>

<head>
    <title>How To Generate Invoice PDF In Laravel 9 - Techsolutionstuff</title>
    <style type="text/css">
        body {
            font-family: 'Roboto Condensed', sans-serif;
        }

        .m-0 {
            margin: 0px;
        }

        .p-0 {
            padding: 0px;
        }

        .pt-5 {
            padding-top: 5px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .text-center {
            text-align: center !important;
        }

        .w-100 {
            width: 100%;
        }

        .w-50 {
            width: 50%;
        }

        .w-85 {
            width: 85%;
        }

        .w-15 {
            width: 15%;
        }

        .logo img {
            width: 200px;
            height: 60px;
        }

        .gray-color {
            color: #5D5D5D;
        }

        .text-bold {
            font-weight: bold;
        }

        .border {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #d2d2d2;
            padding: 7px 8px;
        }

        th {
            background: #F4F4F4;
            font-size: 15px;
        }

        td {
            font-size: 13px;
            text-align: center;
        }

        .box-text p {
            line-height: 10px;
            margin: 5px 0;
        }

        .float-left {
            float: left;
        }

        .total-part {
            font-size: 16px;
            line-height: 12px;
            margin-top: 10px;
            clear: both;
        }

        .total-left {
            width: 85%;
            float: left;
            text-align: right;
        }

        .total-right {
            width: 15%;
            float: left;
            text-align: right;
            padding-right: 20px;
        }
    </style>
</head>

<body>

    <div class="head-title">
        <h1 class="text-center m-0 p-0">Facture</h1>
    </div>
    <div class="add-detail mt-10">
        <div class="w-50 float-left mt-10">
            <p class="m-0 pt-5 text-bold w-100">Numero Facture <span class="gray-color">{{$facture->num_facture}}</span>
            </p>
            <p class="m-0 pt-5 text-bold w-100">Date Facture <span class="gray-color">{{date(" d-m-Y",
                    strtotime($facture->created_at))}}</span></p>

        </div>

        <div class="w-50 float-left logo mt-10">
            <img src="dist/img/1650884807652.jpeg" alt="Logo">
        </div>
        <div style="clear: both;"></div>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100">
            <tr>
                <th class="w-50">Expéditeur</th>
            </tr>
            <tr>
                <td>
                    <div class="box-text pull-left">
                        {{-- <p>{{$client->client}}</p>
                        <p>{{$client->Adresse}}</p>
                        <p>{{$client->Pays}}</p>
                        <p>Tel: {{$client->Tel1}}</p>
                        <p>Fax: {{$client->Fax}}</p>
                        <p>Email: {{$client->email}}</p> --}}
                        <p>DANOSA MAROC</p>
                        <p>2230 BD ABDELMOUMEN MAARIF CASABLANCA</p>
                        <p>MAROC</p>
                        <p>Tel:0663242615 </p>
                        <p>Fax: 0663278954</p>
                        <p>Email: DANOSA.MAROC@gmail.com</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="table-section bill-tbl w-100 mt-10">
        <table class="table w-100">
            <tr>
                <th class="w-50">Charge</th>
                <th class="w-50">Serie Facture</th>
                <th class="w-50">Prix</th>
            </tr>
            @foreach($charges as $charge)
            <tr>
                <td> {{$charge->Designation_Charge}}</td>
                <td>{{$charge->serie_facture}}</td>
                <td> {{$charge->valeur}}DH</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">
                    <div class="total-part">
                        <div class="total-left float-left" align="right">
                            @if($devise->Code_Devise != 'DH')
                            <p>Cours Change</p>
                            @endif
                            <p>Total Payable</p>
                        </div>
                        <div class="total-right float-left text-bold" align="right">
                            @if($devise->Code_Devise != 'DH')
                            <p>{{$devise->Cours}}</p>
                            @endif
                            <p> {{$valeur_net}}{{$devise->Code_Devise}}</p>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
