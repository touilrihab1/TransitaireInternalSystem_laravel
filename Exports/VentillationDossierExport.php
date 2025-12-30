<?php

namespace App\Exports;

use App\Models\Ventillation_dossier;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class VentillationDossierExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id_dossier;
    public function __construct($id_dossier)
{
    $this->id_dossier = $id_dossier;
}
    public function collection()
    {
      
      $ventillations = DB::table('ventillations_dossier')->select('code_nomenclature','code_article',
    'origin','unite_mesure','qte_total','poids_net_total',
    'valeur_devise_total','code_devise','cours_devise','contre_valeur_DH')
    ->where('id_dossier', '=', $this->id_dossier)
    ->get();
    $headings = [
        'code nomenclature',
        'code article',
        'origin',
        'unite mesure' ,
        'quantité total',
        'poids net total',
        'valeur devise total',
        'code devise' ,
        'cours devise',
        'contre valeur en DH'
    ];
    $collection = collect([$headings]);
    foreach(  $ventillations as  $ventillation){
        $collection->push([
            $ventillation->code_nomenclature ,
            $ventillation->code_article,
            $ventillation->origin,
            $ventillation->unite_mesure,
            $ventillation->qte_total,
            $ventillation->poids_net_total,
            $ventillation->valeur_devise_total,
            $ventillation->code_devise,
            $ventillation->cours_devise,
            $ventillation->contre_valeur_DH
        ]);
    }
    return $collection;
    }
}
