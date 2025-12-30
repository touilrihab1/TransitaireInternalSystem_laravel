@extends('clientView.home')
@section('formuleClient')
<style>
         .container {
            width: 85% !important;
            max-width: 85% !important;
        }

        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            /* Add padding to the card */
        }
</style>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Mes Dossiers</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>N° Dum</th>
                            <th>N° Dossier</th>
                            <th>Date Dossier</th>
                            <th>Date d'arrivé</th>
                            <th>Expéditeur</th>
                            <th>Poids Brut</th>
                            <th>Poids Net</th>
                            <th>Nombre colis</th>
                            <th>Etat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dossiers as $dossier)
                        <tr>
                            <td>{{ $dossier->num_dum }}</td>
                            <td>{{ $dossier->n_dossier }}</td>
                            <td>{{ date("d-m-Y", strtotime($dossier->created_at)) }}</td>
                            <td>{{ date("d-m-Y", strtotime($dossier->date_arrive)) }}</td>
                            <td>{{ $dossier->expediteur }}</td>
                            <td>{{ $dossier->poids_brut }}</td>
                            <td>{{ $dossier->poids_net }}</td>
                            <td>{{ $dossier->n_colis }}</td>
                            <td>{{ $dossier->Libelle_Sous_Statut }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
      
    </div>

</div>
@endsection
