<?php

namespace App\Http\Controllers;

use App\Models\Dum;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Http\Requests\StoreDumRequest;
use App\Http\Requests\UpdateDumRequest;
use App\Models\Client;
use App\Models\Dossier;

class DumController extends Controller
{
    public $selectedClientId;

    public function index()
    {
        $devise = DB::table('devise')->select('Code_Devise', 'Intitule_Devise')->get();

        return view('formulaire1', compact('devise'));
    }

    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $dums = Dum::all();

    //     $bureaus = $dums->mapWithKeys(function ($dm, $key) {
    //         return [$dm->bureau => $dm->type_dum];
    //     });

    //     // dd($bureaus);
    //     return view('dum.index', compact('dums', 'bureaus'));
    // }
    public function getId(Request $request )
    {
        $devise = DB::table('devise')->select('Code_Devise', 'Intitule_Devise')->get();
       $id_dossier = $request->id1 ;
       $nx = DB::table('dum_dossier')
       ->where('id_dossier',decrypt($id_dossier))->first() ;
       //dd($nx);
      if($nx != null)
      {
        Session::flash('error', 'le dossier est déja déclaré.');
        return redirect('/tableDossierDed');
       

      }
      else{
        return view('formulaire1', ['id_dossier' => $id_dossier]);
          }
      
    }
    public function voir($num_dum)
    {
       $dum = dum::where('num_dum',$num_dum)->first() ;
       $client = Client::find($dum->id_client) ;
       return view('voirDum', ['dum' => $dum , 'client' => $client]);
    }
    public function show(Request $request, $id_crypte)
    {
        $id = decrypt($id_crypte);
        $request->session()->put('id', $id);
        return view('formulaire1', ['id_decrypte' => $id]);

  
    }
    public function modifier(Request $request)
    {
        $id_dum= decrypt($request->dum) ;
        $dum = Dum::find($id_dum) ;
        $client = Client::find($dum->id_client) ;
    
        return view("modifierDum" ,['dum'=>$dum , 'client'=>$client ] ) ;
    }
    public function save(Request $request)
    { //  $id_dossier= $request->session()->get('id')

        $id_dossier = decrypt($request->id_dossier);
        $dum = new Dum();
        $dum->num_dum = session()->get('num_dum');
        $dum->num_sous_dum = $request->sdum;
        $dum->bureau_dedouanement = $request->bureau_dedouanement;

        $dum->arrondissement = $request->arrondissement;
        $dum->regime = $request->regime;
        $dum->n_serie = $request->n_serie;
        $dum->lettre = $request->lettre;
        $dum->repertoire = $request->repertoire;
        $dum->date_debut = $request->date_debut;
        $dum->date_fin = $request->date_fin;
        $dum->declaration = $request->declaration;
        //   $dum->activite = $request->activite;
        $dum->devise = $request->devise;
        //  dd($request->code_client);
        //*********************************** */
        $client = Client::where('Code_Tiers', $request->Code_Tiers)
            ->get();
        $dum->id_client = $client[0]->Id;

        $dum->bureau_destination = $request->bureau_destination;
        ///******************************** */
        $dum->save();
        DB::insert('insert into dum_dossier (id_dum, id_dossier) values (?, ?)', [$dum->id, $id_dossier]);

        //------------ ???? -----------------------------
        //$table->string('type_dum')->nullable(); // Exportation - Importation
        //$table->integer('etat_dum')->nullable();


        return redirect('/tableDossierDed')->with('status', 'Le formulaire a été enregistré avec succès.');
    }
    public function save1(Request $request)
    { //  $id_dossier= $request->session()->get('id')

      
        $dum = new Dum();
        $dum->num_dum = session()->get('num_dum');
        $dum->num_sous_dum = $request->sdum;
        $dum->bureau_dedouanement = $request->bureau_dedouanement;

        $dum->arrondissement = $request->arrondissement;
        $dum->regime = $request->regime;
        $dum->n_serie = $request->n_serie;
        $dum->lettre = $request->lettre;
        $dum->repertoire = $request->repertoire;
        $dum->date_debut = $request->date_debut;
        $dum->date_fin = $request->date_fin;
        $dum->declaration = $request->declaration;
        //   $dum->activite = $request->activite;
        $dum->devise = $request->devise;
        //  dd($request->code_client);
        //*********************************** */
        $client = Client::where('Code_Tiers', $request->Code_Tiers)
            ->get();
        $dum->id_client = $client[0]->Id;

        $dum->bureau_destination = $request->bureau_destination;
        ///******************************** */
        $dum->save();
       

        //------------ ???? -----------------------------
        //$table->string('type_dum')->nullable(); // Exportation - Importation
        //$table->integer('etat_dum')->nullable();


        return redirect('/tableDossierDed')->with('status', 'Le formulaire a été enregistré avec succès.');
    }
}
