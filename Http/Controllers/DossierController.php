<?php

namespace App\Http\Controllers;

use App\Exports\DossierExport;
use App\Models\Affectation;
use App\Models\Dossier;
use App\Models\Dum;
use App\Models\File;
use App\Models\Log;
use App\Models\Role;
use App\Models\NumDossier;
use Carbon\Carbon;
use App\Models\Client;
use DataTables;
use Illuminate\Http\Request;
use App\Models\TypeFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

//use Spatie\Permission\Models\Role;

class DossierController extends Controller
{
    public function index(Request $request)
    {
        $sortable = app(Sortable::class);
        $sortable->appends($request->except('page'));

        $dossiers = Dossier::sortable($sortable)->paginate(5);

        return view('tableDossier')
            ->with('dossiers', $dossiers)
            ->with('sortable', $sortable);
    }


    public function save(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'date_dedouanement' => 'required',
            'type' => 'required',

        ]);


        $dossier = new Dossier();
        $dossier->n_dossier = $request->num_dossier;

        $dossier->date_arrive = $request->date_arrive;
        $dossier->date_dedouanement = $request->date_dedouanement;
        $dossier->heure_sortie = $request->heure_sortie;
        $dossier->destination = $request->provenance;
        $dossier->date_dedouanement2 = $request->date_dedouanement2;
        $dossier->transporteur = $request->transporteur;
        $dossier->n_manifeste = $request->n_manifeste;

        if ($request->moyen_transport == 'routiere') {
            $dossier->moyen_transport = $request->moyen_transport;
            $dossier->n_moyen = $request->n_moyen2;
        } else if ($request->moyen_transport == 'maritime') {
            $dossier->moyen_transport = $request->moyen_transport;
            $dossier->n_moyen = $request->n_moyen1;
        } else if ($request->moyen_transport == 'aerien') {
            $dossier->moyen_transport = $request->moyen_transport;
            $dossier->n_moyen = $request->n_moyen3;
        }
        $dossier->connaissement = $request->connaissement;

        $dossier->destinataire = $request->destinataire ;
        $dossier->client_facturation = $request->client_facturation;
        $dossier->n_tc = $request->n_tc;
        $dossier->poids_brut = $request->poids_brut;
        $dossier->poids_net = $request->poids_net;
        $dossier->val_total_declare = $request->val_tot_declare;
        $dossier->n_palette = $request->nbr_pallette;
        $dossier->n_colis = $request->nbr_colis;
        $dossier->designation_marchandise = $request->design_marchandise;
        $dossier->expediteur = $request->Expediteur;
        $dossier->contact_receptionnaire = $request->ctct_receptio;
        $dossier->centre_cout = $request->centre_cout;

        $dossier->demandeur = $request->Demandeur;


        $dossier->type_dossier = $request->type;
        if ($request->type == 'import') {
            $dossier->type_dossier = 'import';
        } else if ($request->type == 'export') {
            $dossier->type_dossier = 'export';
        }

        if (isset($request->dossier_definitive)) {
            $dossier->definitive = true;
        } else {
            $dossier->definitive = false;
        }



        $dossier->save();
        //---------------------generer num dossier--------------------------------

        if ($dossier->type_dossier == 'export') {
            $num1 = NumDossier::find(1);
            $num = sprintf("%07d", $num1->export);
            $dossier->n_dossier = "EX" . $num;
            //  Dossier::find($dossier->id)
            //          ->insert(['n_dossier'=>$dossier->n_dossier]) ;
            $num1->export = $num1->export + 1;
            DB::table('num_dossiers')->where('id', 1)->update(['export' => $num1->export]);
        } else if ($dossier->type_dossier == 'import') {
            $num1 = NumDossier::find(1);
            $num = sprintf("%07d", $num1->import);
            $dossier->n_dossier = "IM" . $num;
            $dossier->save();
            $num1->import = $num1->import + 1;
            DB::table('num_dossiers')->where('id', 1)->update(['import' => $num1->import]);
        }
        $dossier->save();
        //-------------------------------------------------------------------------------------------

        $id = $dossier->id;
        $id_crypte = Crypt::encrypt($id);
        //******************************* */
        $log = Log::create([
            'id_dossier' => $dossier->id,
            'id_user' => auth()->user()->id,
            'tache' => 'créer dossier'
        ]);
        $log->save();
        //******************************** */


        DB::insert('insert into dossier_tracking (id_dossier, id_statut ,created_at) values (?, ?, ?)', [$id, 50, Carbon::now()]);

        return redirect()->route('get.fileupload', ['idaze' => $id_crypte, 'num' => $dossier->n_dossier]);

    }
    public function show()
    {
        $dossiers = Dossier::sortable()
        ->leftJoin('dum_dossier', 'dossiers.id', '=', 'dum_dossier.id_dossier')
            ->leftJoin('dums', 'dum_dossier.id_dum', '=', 'dums.id')
            ->leftJoin('dossier_tracking', function ($join) {
                $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
                    ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
            })
            ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
            ->select('dossiers.*', 'dums.num_dum', 'statut_dossier.Libelle_Sous_Statut')
            ->orderBy('dossier_tracking.created_at', 'desc')
            ->get();
          
           
        return view('tableDossier', ['dossiers' => $dossiers ]);

    }




    public function search(Request $request)
    {
        $query = $request->input('query');

        $dossiers = Dossier::where('n_dossier', 'LIKE', "%$query%")
         ->leftJoin('dossier_tracking', function ($join) {
            $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
                ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
        })
        ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
        ->select('dossiers.*',  'statut_dossier.Libelle_Sous_Statut')
        ->orderBy('dossier_tracking.created_at', 'desc')
        ->get();


        return view('tableDossier', ['dossiers' => $dossiers]);
    }

    public function filter(Request $request)
    {
        $type_dossier = $request->input('type_dossier');

        $query = Dossier::query();

        if ($type_dossier) {
            $query->where('type_dossier', $type_dossier);
        }

        $dossiers = $query  ->leftJoin('dossier_tracking', function ($join) {
            $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
                ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
        })
        ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
        ->select('dossiers.*',  'statut_dossier.Libelle_Sous_Statut')
        ->orderBy('dossier_tracking.created_at', 'desc')->paginate(10);

        return view('tableDossier', ['dossiers' => $dossiers]);

    }



    public function showDedouanement()
    {
        $dossiers = Dossier::sortable()
        ->leftJoin('dum_dossier', 'dossiers.id', '=', 'dum_dossier.id_dossier')
            ->leftJoin('dums', 'dum_dossier.id_dum', '=', 'dums.id')
            ->join('affectation', 'dossiers.id', '=', 'affectation.id_dossier')
            ->select('dossiers.*', 'dums.num_dum')
            ->where('affectation.id_role', '=', '3')
            ->get();

        return view('tableDossierDed', ['dossiers' => $dossiers]);
    }


    //----------------------export excel---------------------//
    public function export()
    {

        return Excel::download(new DossierExport, 'listDossier.xlsx');
    }
    public function modifier(Request $request)
    {

        $id = decrypt($request->input('id'));
        $dossier = Dossier::find($id);
        $departements = Role::all();
        return view("modifierDossier", ['dossier' => $dossier, 'departements' => $departements]);
    }

    public function saveModification(Request $request)
    {

        $id = decrypt($request->input('id'));

        $dossier = Dossier::find($id);

        $dossier->date_arrive = $request->date_arrive;
        $dossier->date_dedouanement = $request->date_dedouanement;
        $dossier->heure_sortie = $request->heure_sortie;
        $dossier->destination = $request->provenance;
        $dossier->date_dedouanement2 = $request->date_dedouanement2;
        $dossier->transporteur = $request->transporteur;
        $dossier->n_manifeste = $request->n_manifeste;
        $dossier->n_tc = $request->n_tc;
        if (auth()->user()->hasPermissionTo('modifier poids brut')) {

            if ($dossier->poids_brut != $request->poids_brut) {
                $log = Log::create([
                    'id_dossier' => $dossier->id,
                    'id_user' => auth()->user()->id,
                    'tache' => 'modifier poids brut'
                ]);
                $log->save();
            }

            $dossier->poids_brut = $request->poids_brut;

        }
        $dossier->poids_net = $request->poids_net;
        $dossier->val_total_declare = $request->val_tot_declare;
        $dossier->n_palette = $request->nbr_pallette;
        $dossier->n_colis = $request->nbr_colis;
        $dossier->designation_marchandise = $request->design_marchandise;
        $dossier->expediteur = $request->expedition;
        // $dossier->client_facturation = $request->chef_facturation;
        $dossier->contact_receptionnaire = $request->ctct_receptio;
        $dossier->centre_cout = $request->centre_cout;
        $dossier->demandeur = $request->demandeur;
        if ($request->moyen_transport == 'routiere') {
            $dossier->moyen_transport = $request->moyen_transport;
            $dossier->n_moyen = $request->n_moyen2;
        } else if ($request->moyen_transport == 'maritime') {
            $dossier->moyen_transport = $request->moyen_transport;
            $dossier->n_moyen = $request->n_moyen1;
        } else if ($request->moyen_transport == 'aerien') {
            $dossier->moyen_transport = $request->moyen_transport;
            $dossier->n_moyen = $request->n_moyen3;
        }
        $dossier->connaissement = $request->connaissement;
        $dossier->type_dossier = $request->type;
        if ($request->type == 'import') {
            $dossier->type_dossier = 'import';
        } else if ($request->type == 'export') {
            $dossier->type_dossier = 'export';
        }

        if (isset($request->dossier_definitive)) {
            $dossier->definitive = true;
        } else {
            $dossier->definitive = false;
        }
        $dossier->save();

        // $dossiers = Dossier::join('dums', 'dossiers.id_dum', '=', 'dums.id')
        //  ->select('dossiers.*', 'dums.num_dum')
        //  ->get();
        $dossiers = Dossier::
        leftJoin('dossier_tracking', function ($join) {
            $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
                ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
        })
        ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
        ->select('dossiers.*',  'statut_dossier.Libelle_Sous_Statut')
        ->orderBy('dossier_tracking.created_at', 'desc')->paginate(10);

        $log = Log::create([
            'id_dossier' => $dossier->id,
            'id_user' => auth()->user()->id,
            'tache' => 'modifier dossier'
        ]);
        $log->save();


        //DB::insert('insert into dossier_tracking (id_dossier, id_statut ,created_at) values (?, ?, ?)', [$id, 52,Carbon::now() ]);

        return view('tableDossier', ['dossiers' => $dossiers]);



    }

    public function cancel()
    {
        dd('ajax request');
    }
    public function voir(Request $request)
    {

        $id = decrypt($request->input('id1'));
        // $log = Log::create([
        //     'id_dossier' => $id,
        //     'id_user' => auth()->user()->id,
        //     'tache' => 'voir dossier'
        // ]);
        // $log->save();

        //-------------------Table des Factures---------------------------
        if (auth()->user()->hasRole('dédouanement')) {
            $dossier = Dossier::find($id);
            $facture = Dossier::find($id)
                ->leftJoin('facture_dossier', 'dossiers.id', '=', 'facture_dossier.id_dossier')
                ->leftJoin('factures', 'facture_dossier.id_facture', '=', 'factures.id')
                ->where('dossiers.id', $id)
                ->select('factures.*')
                ->get();
            return view("showDossier", ['dossier' => $dossier, 'factures' => $facture]);
        } else {
            $dossier = Dossier::where('id',$id)
            ->leftJoin('dossier_tracking', function ($join) {
                $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
                    ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
            })
            ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
            ->select('dossiers.*',  'statut_dossier.Libelle_Sous_Statut')
            ->orderBy('dossier_tracking.created_at', 'desc')->first();
           
            return view("showDossier", ['dossier' => $dossier]);
        }

    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('query');

        // Perform your database query to fetch matching clients based on the $query
        $clients = Client::where('Raison_Sociale', 'LIKE', '%' . $query . '%')->get();

        // Return the matching clients as JSON response
        return response()->json($clients);
    }
    public function cloturer(Request $request)
    {
        $id_dossier = decrypt($request->ido) ;
        DB::insert('insert into dossier_tracking (id_dossier, id_statut, created_at) values (?, ?, ?)', [$id_dossier, 55, Carbon::now()]);
        $log = Log::create([
                      'id_dossier' => $id_dossier,
                      'id_user' => auth()->user()->id,
                      'tache' => 'clotuter dossier'
                  ]);
                  $log->save();
                return  $this->show() ;
        
    }
}

