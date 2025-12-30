<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use App\Models\Dossier_tracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartJSController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        //-------------------------Dashboard Exploitation---------------------------
        if (auth()->user()->hasRole('exploitation')) {

            $dossiers = Dossier::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(dossiers.created_at) as month_name"))
                ->whereYear('dossiers.created_at', date('Y'))
                ->leftJoin('logs', 'dossiers.id', '=', 'logs.id_dossier')
                ->where('logs.id_user', auth()->user()->id)
                ->where('logs.tache', 'créer dossier')
                ->groupBy('month_name')
                ->orderBy('month_name', 'ASC')
                ->pluck('count', 'month_name');

            $labels = $dossiers->keys()->toArray();
            $data = $dossiers->values()->toArray();
            //----------------dossier creer aujourdhui-+--------------------------
            $nbr_dossier = DB::table('logs')
                ->where('logs.id_user', auth()->user()->id)
                ->where('logs.tache', 'créer dossier')
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->count();





            //---------------------dossier incomplet------------------------------
            $nbr_incomplet = Dossier::leftJoin('dossier_tracking', function ($join) {
                $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
                    ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
            })
                ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
                ->select('dossiers.*', 'statut_dossier.Id_Sous_Statut')
                ->orderBy('dossier_tracking.created_at', 'desc')
                ->where('Id_Sous_Statut', 1)


                ->count();

            $nbr_cloture = DB::table('logs')
                ->where('logs.id_user', auth()->user()->id)
                ->where('logs.tache', 'clotuter dossier')
                ->whereDate('created_at', '=', Carbon::today()->toDateString())
                ->count();

            return view('home', compact('labels', 'data', 'nbr_dossier', 'nbr_incomplet', 'nbr_cloture'));
        }
        //------------------------------------Dashboard Admin-------------------------------------
        // else if (auth()->user()->hasRole('Admin')) {
        //     $dossiers = Dossier::select(
        //         DB::raw("COUNT(*) as count"),
        //         DB::raw("DATENAME(MONTH, dossiers.created_at) as month_name")
        //     )
        //         ->whereYear('dossiers.created_at', date('Y'))
        //         ->groupByRaw("DATENAME(MONTH, dossiers.created_at)") // Use ordinal position in GROUP BY
        //         ->orderByRaw("DATENAME(MONTH, dossiers.created_at) ASC") // Use ordinal position in ORDER BY
        //         ->pluck('count', 'month_name');

        //     $labels = $dossiers->keys()->toArray();
        //     $data = $dossiers->values()->toArray();

        //     $nbr_operation = DB::table('logs')
        //         ->whereDate('created_at', '=', date('Y-m-d'))
        //         ->count();

        //     $operateur = DB::table('users')
        //         ->where('isclient', 0)
        //         ->count();

        //     $client = DB::table('users')
        //         ->where('isclient', 1)
        //         ->count();

        //     // Further code logic and processing...

        //     return view('home', compact('labels', 'data', 'nbr_operation', 'operateur', 'client'));
        // }
        else if (auth()->user()->hasRole('Admin')) {

            $dossiers = Dossier::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(dossiers.created_at) as month_name"))

                ->whereYear('dossiers.created_at', date('Y'))
                ->groupBy('month_name')
                ->orderBy('month_name', 'ASC')
                ->pluck('count', 'month_name');
            $labels = $dossiers->keys()->toArray();

            $data = $dossiers->values()->toArray();
            $nbr_operation = DB::table('logs')
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->count();
            $operateur = DB::table('users')
                ->where('isclient', 0)
                ->count();
            $client = DB::table('users')
                ->where('isclient', 1)
                ->count();
            // Further code logic and processing...

            return view('home', compact('labels', 'data', 'nbr_operation', 'operateur', 'client'));
        } else if (auth()->user()->hasRole('dédouanement')) {
            $dossier_ded = DB::table('affectation')
                ->where('id_role', 3)
                ->select(DB::raw("COUNT(*) as count"), DB::raw("DATE(affectation.created_at) as day"))
                ->whereYear('affectation.created_at', date('Y'))
                ->count();

            $dossier_declare = DB::table('dums')
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->count();


            return view('home', compact('dossier_ded', 'dossier_declare'));
        } else if (auth()->user()->hasRole('facturation')) {
            $facture_paye = DB::table('facturefinal_dossier')->where('etat', 'payé')->get()->count();
            $facture_non_paye = DB::table('facturefinal_dossier')->where('etat', 'non payé')->get()->count();

            $dossiers = Dossier::leftJoin('dum_dossier', 'dossiers.id', '=', 'dum_dossier.id_dossier')
                ->leftJoin('dums', 'dum_dossier.id_dum', '=', 'dums.id')
                ->join('affectation', 'dossiers.id', '=', 'affectation.id_dossier')
                ->select('dossiers.*', 'dums.num_dum')
                ->where('affectation.id_role', '=', '5')
                ->get();

            return view('home', ['dossiers' => $dossiers, 'facture_paye' => $facture_paye, 'facture_non_paye' => $facture_non_paye]);

        }
    }


}
