@extends('layouts.admin')

@section('formule')
<head>
    <link href="css/style.css" rel="stylesheet">

</head>
<div>
    <br>
    <br>
    <table class="table table-bordered">
        <tr>
            <th>Code NGP</th>
            <th>Code Article</th>
            <th>Pays</th>
            <th>Unite_Mesure</th>
            <th>Qte total</th>
            <th>Poids net total</th>
            <th>valeur devise total</th>
        </tr>
        @foreach($qte as $code_ngp => $code_ngp_data)
            @foreach($code_ngp_data as $code_article => $code_article_data)
                @foreach($code_article_data as $origin => $origin_data)
                    @foreach($origin_data as $unite => $qte_total)
                        <tr>
                            <td>{{ $code_nomenclature }}</td>
                            <td>{{ $code_article1 }}</td>
                            <td>{{ $origin }}</td>
                            <td>{{ $code_unite }}</td>
                            <td>{{ $qte_total }}</td>
                            <td>{{ $poids_net[$code_ngp][$code_article][$origin][$unite] }}</td>
                            <td>{{ $valeur_devise[$code_ngp][$code_article][$origin][$unite] }}</td>
                        </tr>
                    @endforeach
                @endforeach
            @endforeach
        @endforeach
    </table>



</div>
@endsection
