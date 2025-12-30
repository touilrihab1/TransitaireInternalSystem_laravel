<?php

namespace App\Http\Controllers;

use App\Models\Ventillation_dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel ;
use App\Exports\VentillationDossierExport;

class FactureDossierController extends Controller
{
    public function ventiller(Request $request)
    {
        $qte = [];
        $poids_net = [];
        $valeur_devise = [];
        $test = [] ;
        $id_dossier = decrypt($request->id1) ;
        if (DB::table('ventillations_dossier')->where('id_dossier', 'LIKE', '%' . $id_dossier . '%')->first()) {

            return Excel::download(new VentillationDossierExport($id_dossier), 'ventillation dossier.xlsx');

        } else {
        $articles =  DB::table('facture_dossier')
                    ->where('id_dossier',$id_dossier)
                    ->leftJoin('ligne_article', 'ligne_article.id_facture' ,'facture_dossier.id_facture')
                    ->select('ligne_article.*')
                    ->get() ; 
                    foreach ($articles as $article) {
                        $code_ngp = $article->id_code_ngp;
                        $code_article = $article->id_code_article;
                        $unite = $article->id_unite;
                        $origin = $article->pays;
        
                        if (!isset($qte[$code_ngp][$code_article][$origin][$unite])) {
                            $qte[$code_ngp][$code_article][$origin][$unite] = 0;
                            $poids_net[$code_ngp][$code_article][$origin][$unite] = 0;
                            $valeur_devise[$code_ngp][$code_article][$origin][$unite] = 0;
                        }
        
                        $qte[$code_ngp][$code_article][$origin][$unite] += $article->qte;
                        $poids_net[$code_ngp][$code_article][$origin][$unite] += $article->poids_net;
                        $valeur_devise[$code_ngp][$code_article][$origin][$unite] += $article->valeur_devise;
                    }
                    foreach ($qte as $code_ngp => $code_ngp_data) {
                        foreach ($code_ngp_data as $code_article => $code_article_data) {
                            foreach ($code_article_data as $origin => $origin_data) {
                                foreach ($origin_data as $unite => $qte_total) {
                                    $code_nomenclature = DB::table('nomenclature')
                                        ->where('Id_Nomenclature', $code_ngp)
                                        ->select('nomenclature.Code_Nomenclature')
                                        ->first();
                                    $code_article1 = DB::table('article')
                                        ->where('Id_Article', $code_article)
                                        ->select('article.Code_Article')
                                        ->first();
                                    $code_unite = DB::table('unite_mesure')
                                        ->where('Id_Unite_Mesure', $unite)
                                        ->select('unite_mesure.Code_Unite')
                                        ->first();
        
                                    $ventillation = DB::table('ventillations_dossier')->insert([
                                        'id_dossier' => $id_dossier,
                                        'code_nomenclature' => $code_nomenclature->Code_Nomenclature,
                                        'code_article' => $code_article1->Code_Article,
                                        'origin' => $origin,
                                        'unite_mesure' => $code_unite->Code_Unite,
                                        'poids_net_total' => $poids_net[$code_ngp][$code_article][$origin][$unite],
                                        'valeur_devise_total' => $valeur_devise[$code_ngp][$code_article][$origin][$unite],
                                        'qte_total' => $qte_total
                                    ]);
                                    //$ventillation->save();
        
                                }
                            }
                        }
                    }
                    return Excel::download(new VentillationDossierExport($id_dossier), 'ventillation_dossier.xlsx');

                }

    }
}
