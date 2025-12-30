<?php

namespace App\Exports;

use App\Models\Dossier;
use Maatwebsite\Excel\Concerns\FromCollection;

class DossierExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {

        // return Dossier::all();
        $dossiers = Dossier::select('n_dossier', 'n_moyen', 'date_arrive', 'expediteur', 'poids_brut', 'poids_net', 'n_colis', 'designation_marchandise')->get();
        $headings = [
            //    ' N° Dum',
            ' N° Dossier',
            ' Date Dossier',
            ' Date d´arrivé',
            ' Expéditeur',
            ' Poids Brut',
            ' Poids Net',
            ' Nombre colis',
            ' Intitule Marchandises',

        ];
        $collection = collect([$headings]);
        foreach ($dossiers as $dossier) {
            $collection->push([
                // $dossier->num_dum,
                $dossier->n_dossier,
                $dossier->n_moyen,
                $dossier->date_arrive,
                $dossier->expediteur,
                $dossier->poids_brut,
                $dossier->poids_net,
                $dossier->n_colis,
                $dossier->designation_marchandise,
            ]);
        }
        return $collection;
    }
}
