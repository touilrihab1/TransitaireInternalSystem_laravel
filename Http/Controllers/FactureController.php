<?php

namespace App\Http\Controllers;

use App\Exports\VentillatonExport;
use App\Models\Dossier;
use App\Models\Ventillation;
use Illuminate\Http\Request;
use App\Models\Facture;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class FactureController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:role-list', ['only' => ['save']]);
    // }
    public $data = [];
    public $info = [];

    public function findFacture(Request $request)
    {
        $idFacture = $request->input('id1');
        $id = decrypt($idFacture);

        $dossier = Dossier::find($id);

        // $dossier = Dossier::leftJoin('dum_dossier', 'dossiers.id', '=', 'dum_dossier.id_dossier')
        //     ->leftJoin('dums', 'dum_dossier.id_dum', '=', 'dums.id')
        //     ->where('dossiers.id', $id)
        //     ->select('dossiers.*', 'dums.num_dum')
        //     ->get();
        return view('addFacture', ['id1' => $idFacture, 'dossier' => $dossier]);
    }

    public function findFactureModifier(Request $request)
    {
        $idFacture = $request->input('id1');
        $id = decrypt($idFacture);
        $facture = Facture::find($id);
        $dossier = DB::table('facture_dossier')
            ->join('dossiers', 'facture_dossier.id_dossier', '=', 'dossiers.id')
            ->join('factures', 'facture_dossier.id_facture', '=', 'factures.id')
            ->where('factures.id', $id)
            ->select('dossiers.*')
            ->get();
        $articles = DB::table('ligne_article')
            ->leftJoin('nomenclature', 'ligne_article.id_code_ngp', '=', 'nomenclature.Id_Nomenclature')
            ->leftJoin('article', 'ligne_article.id_code_article', '=', 'article.Id_Article')
            ->leftJoin('unite_mesure', 'ligne_article.id_unite', '=', 'unite_mesure.Id_Unite_Mesure')
            ->leftJoin('factures', 'factures.id', '=', 'ligne_article.id_facture')
            ->where('factures.id', $id)
            ->select('ligne_article.*', 'nomenclature.Code_Nomenclature', 'article.Code_Article', 'unite_mesure.Code_Unite')
            ->get();

        return view('modifierFacture', ['id1' => $idFacture, 'dossier' => $dossier, 'facture' => $facture, 'articles' => $articles]);
    }
    public function saveData(Request $request)
    {

        $this->data = $request->data;

    }
    public function voir(Request $request)
    {
        $id = decrypt($request->input('id1'));
        $facture = Facture::find($id);
        $articles = DB::table('ligne_article')
            ->leftJoin('nomenclature', 'ligne_article.id_code_ngp', '=', 'nomenclature.Id_Nomenclature')
            ->leftJoin('article', 'ligne_article.id_code_article', '=', 'article.Id_Article')
            ->leftJoin('unite_mesure', 'ligne_article.id_unite', '=', 'unite_mesure.Id_Unite_Mesure')
            ->leftJoin('factures', 'factures.id', '=', 'ligne_article.id_facture')
            ->where('factures.id', $id)
            ->select('ligne_article.*', 'nomenclature.Code_Nomenclature', 'article.Code_Article', 'unite_mesure.Code_Unite')
            ->get();
        $dossier = DB::table('facture_dossier')
            ->join('dossiers', 'facture_dossier.id_dossier', '=', 'dossiers.id')
            ->join('factures', 'facture_dossier.id_facture', '=', 'factures.id')
            ->where('factures.id', $id)
            ->select('dossiers.*')
            ->first();


        // if(Ventillation::where('id_facture','LIKE', '%' . $id. '%')
        // ->first())
        // {
        //    $color_btn = 1 ;
        // }
        // else{
        //   $color_btn = 0 ;
        // }
        return view('showFacture', ['factures' => $facture, 'articles' => $articles, 'dossier' => $dossier]);
    }

    public function ventiller(Request $request)
    {

        $qte = [];
        $poids_net = [];
        $valeur_devise = [];
        $id_facture = decrypt($request->input('id1'));
        //if(!Ventillation::where('id_facture', '=', $id_facture)->first()){
        if (Ventillation::where('id_facture', 'LIKE', '%' . $id_facture . '%')->first()) {

            return Excel::download(new VentillatonExport($id_facture), 'ventillation.xlsx');
        } else {
            // dd('not found') ;
            $articles = DB::table('ligne_article')
                ->select('ligne_article.*')
                ->where('ligne_article.id_facture', $id_facture)
                ->get();
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

                            $ventillation = Ventillation::create([
                                'id_facture' => $id_facture,
                                'code_nomenclature' => $code_nomenclature->Code_Nomenclature,
                                'code_article' => $code_article1->Code_Article,
                                'origin' => $origin,
                                'unite_mesure' => $code_unite->Code_Unite,
                                'poids_net_total' => $poids_net[$code_ngp][$code_article][$origin][$unite],
                                'valeur_devise_total' => $valeur_devise[$code_ngp][$code_article][$origin][$unite],
                                'qte_total' => $qte_total
                            ]);
                            $ventillation->save();

                        }
                    }
                }
            }

            return Excel::download(new VentillatonExport($id_facture), 'ventillation.xlsx');
        }

    }

    public function modifier(Request $request)
    {

        $id = decrypt($request->input('id1'));
        $facture = Facture::find($id);
        $articles = DB::table('ligne_article')
            ->leftJoin('nomenclature', 'ligne_article.id_code_ngp', '=', 'nomenclature.Id_Nomenclature')
            ->leftJoin('article', 'ligne_article.id_code_article', '=', 'article.Id_Article')
            ->leftJoin('unite_mesure', 'ligne_article.id_unite', '=', 'unite_mesure.Id_Unite_Mesure')
            ->leftJoin('factures', 'factures.id', '=', 'ligne_article.id_facture')
            ->where('factures.id', $id)
            ->select('ligne_article.*', 'nomenclature.Code_Nomenclature', 'article.Code_Article', 'unite_mesure.Code_Unite')
            ->get();
        $dossier = DB::table('facture_dossier')
            ->join('dossiers', 'facture_dossier.id_dossier', '=', 'dossiers.id')
            ->join('factures', 'facture_dossier.id_facture', '=', 'factures.id')
            ->where('factures.id', $id)
            ->select('dossiers.*')
            ->first();
        return view("livewire.facture-modifier-component", ['factures' => $facture, 'articles' => $articles, 'dossier' => $dossier]);
    }



}