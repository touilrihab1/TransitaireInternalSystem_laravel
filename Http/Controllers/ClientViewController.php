<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClientViewController extends Controller
{
     /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        //-------------------------Dashboard Exploitation---------------------------
       if(auth()->user()->hasRole('client')){
        
        $dossiers = Dossier::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(dossiers.created_at) as month_name"))
        ->whereYear('dossiers.created_at', date('M'))
        ->leftJoin('logs', 'dossiers.id', '=', 'logs.id_dossier')
        ->where('logs.id_user',auth()->user()->id) // Remplacez $userId par l'ID de l'utilisateur souhaité
        ->where('logs.tache', 1)
        ->groupBy('month_name')
        ->orderBy('month_name', 'ASC')
        ->pluck('count', 'month_name');
            
            $labels = $dossiers->keys()->toArray();
            $data = $dossiers->values()->toArray();
//----------------dossier creer aujourdhui-+--------------------------
          
          return view('clientHome');
        }
    }
   public function statistic()
   {
    $client =  DB::table('user_client')
->where('id_user',auth()->user()->id)
->leftJoin('clients','user_client.id_client','=','clients.Id')
->select('clients.*')
->first();

$dossiers = DB::table('dossiers')
->where('expediteur',$client->Raison_Sociale)
->leftJoin('dum_dossier','dum_dossier.id_dossier','=','dossiers.id')
->leftJoin('dums','dum_dossier.id_dum','=','dums.id')
->leftJoin('dossier_tracking', function ($join) {
            $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
           ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
    })
    ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
    ->select('dossiers.*', 'dums.num_dum', 'statut_dossier.Libelle_Sous_Statut')
    ->select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(dossiers.created_at) as month_name"))
->whereYear('dossiers.created_at', date('Y'))
->groupBy('month_name')
->orderBy('month_name', 'ASC')
->orderBy('dossier_tracking.created_at', 'desc')
->pluck('count', 'month_name');

 
$labels = $dossiers->keys()->toArray();
$data = $dossiers->values()->toArray();


  $dossier_dedouanmement =  DB::table('dossiers')
->where('expediteur',$client->Raison_Sociale)
->leftJoin('dum_dossier','dum_dossier.id_dossier','=','dossiers.id')
->leftJoin('dums','dum_dossier.id_dum','=','dums.id')
->leftJoin('dossier_tracking', function ($join) {
            $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
           ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
    })
    ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
    ->select('dossiers.*', 'dums.num_dum', 'statut_dossier.Libelle_Sous_Statut')
->where('statut_dossier.Libelle_Sous_Statut','Affecter Dédouanement')
->get()->count();


  $dossier_encours = DB::table('dossiers')
  ->where('expediteur',$client->Raison_Sociale)
  ->leftJoin('dum_dossier','dum_dossier.id_dossier','=','dossiers.id')
  ->leftJoin('dums','dum_dossier.id_dum','=','dums.id')
  ->leftJoin('dossier_tracking', function ($join) {
              $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
             ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
      })
      ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
      ->select('dossiers.*', 'dums.num_dum', 'statut_dossier.Libelle_Sous_Statut')
->where('statut_dossier.Libelle_Sous_Statut','Manque Documents')
->get()->count();
  $dossier_cloture =DB::table('dossiers')
  ->where('expediteur',$client->Raison_Sociale)
  ->leftJoin('dum_dossier','dum_dossier.id_dossier','=','dossiers.id')
  ->leftJoin('dums','dum_dossier.id_dum','=','dums.id')
  ->leftJoin('dossier_tracking', function ($join) {
              $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
             ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
      })
      ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
      ->select('dossiers.*', 'dums.num_dum', 'statut_dossier.Libelle_Sous_Statut')
->where('statut_dossier.Libelle_Sous_Statut','Dossier cloturer')
->get()->count();

//===============================Pie Chart ==================================
$labels1 = ['dossier ouvrit', 'dossier en cours', 'dossier cloturé'];
$values1 = [$dossier_dedouanmement , $dossier_encours,  $dossier_cloture];
$colors1 = ['#FF6384', '#36A2EB', '#FFCE56'];

$data1 = [
    'labels1' => $labels1,
    'values1' => $values1,
    'colors1' => $colors1,
];
$facture =  DB::table('facturefinal_dossier')
->where('id_client',$client->Id)
->where('etat','non payé')->get()->count();

 // return view('clientView.statistique', compact('labels', 'data','dossier_dedouanmement'));
  return view('clientView.statistique', compact('labels1', 'data1','values1','colors1','labels', 'data','dossier_dedouanmement','facture'));
   }
   public function showDossier()
   {
   
$client =  DB::table('user_client')
->where('id_user',auth()->user()->id)
->leftJoin('clients','user_client.id_client','=','clients.Id')
->select('clients.*')
->first();
$dossiers = DB::table('dossiers')
->where('expediteur',$client->Raison_Sociale)
->leftJoin('dum_dossier','dum_dossier.id_dossier','=','dossiers.id')
->leftJoin('dums','dum_dossier.id_dum','=','dums.id')
->leftJoin('dossier_tracking', function ($join) {
            $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
           ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
    })
    ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
    ->select('dossiers.*', 'dums.num_dum', 'statut_dossier.Libelle_Sous_Statut')
    ->get();


return view('clientView.dossier', ['dossiers' => $dossiers]);
   }
       
}
