<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FactureController;
use App\Models\Article;
use App\Models\devise;
use App\Models\Dossier;
use App\Models\Facture;
use App\Models\incoterm;
use App\Models\LigneArticle;
use App\Models\nomenclature;
use App\Models\origin;
use App\Models\UnityMesure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use \App\Http\Requests\StorePostRequest;

class AddLineArticle extends Component
{
    public $designation;
    public $Qte;
    public $unityMesureSearch;
    public $code_ngp;
    public $code_article;
    public $pays;
    public $poids_net;
    public $valeur_devise;
    public $data = [];
    public $Code_Unite;
    public $records;
    public $records_ngp;
    public $records_article;
    public $records_design;
    public $records_pays;
    public $showdiv = false;
    public $showdiv_article = false;
    public $showdiv_design = false;
    public $showdiv_pays = false;
    public $showdiv_ngp = false;
    public $search_ngp = false;
    public $Code_Nomenclature;
    public $Designation_Article;
    public $Intitule_Origine;
    public $Code_Article;
    public $id1;
    public $newItem;
    public $check;
    public $dossier;
    public $poids_netE;
    public $poids_brut;

    public $somme_net = 0;
    public $somme_valeur_devise = 0;

    public function updatedPoidsNet()
    {
        if (!empty($this->poids_brut) && $this->poids_netE > $this->poids_brut) {
            $this->addError('poids_net', 'Poids Net cannot be greater than Poids Brut.');
        } else {
            $this->resetErrorBag('poids_net');
        }
    }

 
    public function searchResult()
    {
        if (!empty($this->unityMesureSearch)) {
            $this->records = unityMesure::orderBy('Code_Unite', 'asc')
                ->where('Code_Unite', 'like', $this->unityMesureSearch . '%')
                ->get();
            $this->showdiv = true;
        } else {
            $this->showdiv = false;
        }
    }

    public function fetchEmployeeDetail($code = 0)
    {
        $record = unityMesure::select('*')
            ->where('Code_Unite', $code)
            ->first();

        if ($record) {
            $this->Code_Unite = $record->Code_Unite;
            $this->unityMesureSearch = $record->Code_Unite;
        }

        $this->showdiv = false;

    }
    //------------------------------//
    public function searchNgp()
    {
        if (!empty($this->code_ngp)) {
            $this->records_ngp = nomenclature::orderBy('Code_Nomenclature', 'asc')
                ->where('Code_Nomenclature', 'like', $this->code_ngp . '%')
                ->get();
            $this->showdiv_ngp = true;
        } else {
            $this->showdiv_ngp = false;
        }
    }

    public function fetchNgp($code = 0)
    {
        $record = nomenclature::select('*')
            ->where('Code_Nomenclature', $code)
            ->first();

        if ($record) {
            $this->Code_Nomenclature = $record->Code_Nomenclature;
            $this->code_ngp = $record->Code_Nomenclature;
        }

        $this->showdiv_ngp = false;

    }

    //----------------------------//
    public function searchArticle()
    {
        if (!empty($this->code_article)) {
            $this->records_article = Article::orderBy('Code_Article', 'asc')
                ->where('Code_Article', 'like', $this->code_article . '%')
                ->get();
            $this->showdiv_article = true;
        } else {
            $this->showdiv_article = false;
        }
    }

    public function fetchArticle($code = 0)
    {
        $record = Article::select('*')
            ->where('Code_Article', $code)
            ->first();

        if ($record) {
            $this->Code_Article = $record->Code_Article;
            $this->code_article = $record->Code_Article;
        }

        $this->showdiv_article = false;

    }

    //----------------------------------//
    public function searchDesign()
    {
        if (!empty($this->designation)) {
            $this->records_design = Article::orderBy('Designation_Article', 'asc')
                ->where('Designation_Article', 'like', $this->designation . '%')
                ->get();
            $this->showdiv_design = true;
        } else {
            $this->showdiv_design = false;
        }
    }

    public function fetchDesign($code = 0)
    {
        $record = Article::select('*')
            ->where('Designation_Article', $code)
            ->first();

        if ($record) {
            $this->Designation_Article = $record->Designation_Article;
            $this->designation = $record->Designation_Article;
        }

        $this->showdiv_design = false;

    }
    //------------------------------//

    public function searchPays()
    {
        if (!empty($this->pays)) {
            $this->records_pays = origin::orderBy('Intitule_Origine', 'asc')
                ->where('Intitule_Origine', 'like', $this->pays . '%')
                ->get();
            $this->showdiv_pays = true;
        } else {
            $this->showdiv_pays = false;
        }
    }

    public function fetchPays($code = 0)
    {
        $record = origin::select('*')
            ->where('Intitule_Origine', $code)
            ->first();

        if ($record) {
            $this->Intitule_Origine = $record->Intitule_Origine;
            $this->pays = $record->Intitule_Origine;
        }

        $this->showdiv_pays = false;

    }
    public function removeItem($index)
    {
        unset($this->data[$index]);
    }

    public function store()
    {
       

        $this->data[] = [
            'designation' => $this->designation,

            'Unite_Mesure' => $this->unityMesureSearch,
            'Qte' => $this->Qte,
            'code_ngp' => $this->code_ngp,

            'code_article' => $this->code_article,

            'pays' => $this->pays,
            'poids_net' => $this->poids_net,
            'valeur_devise' => $this->valeur_devise,
        ];
        Session::put('data', $this->data);

        $this->somme_net = $this->somme_net + $this->poids_net;
        if ($this->newItem) {
            $this->data[] = $this->newItem;
            $this->newItem = '';
        }
        Session::flash('message', 'Articles have been created successfully.');
        //session()->flash('message', 'Articles have been created successfully.');
    }


    public function updatedData()
    {
        // Calculate the total Poids Net
        $this->poids_net_total = array_sum(array_column($this->data, 'poids_net'));
    }


    // public function save(StorePostRequest $request)
    public function save(Request $request)
    {
           //   foreach ($data as $article) {
//             $this->somme_net = $this->somme_net + $article['poids_net'];
//             $this->somme_valeur_devise = $this->somme_valeur_devise + $article['valeur_devise'];
//         }
//         if ($request->poids_net != $this->somme_net) {
//             //errreuuuuuuur
//             // return view('livewire.add-line-article' ,['id_dossier'=> $request->input('id1')]);
//         }
//         if ($request->val_devise != $this->somme_valeur_devise) {
//             //erreeuuer
//         }



    // Comparaison pour définir $x
    // if ($request->poids_net != $this->somme_net) {
    //     $x = true;
    // } else {
    //     $x = false;
    // }

  
   
    if (isset($_POST['ajouter_facture'])) {
        $this->check = 0;
    } else if (isset($_POST['valide'])) {

        $this->check = 1;
    }

    $data = Session::get('data');

   
    
    $facture = new Facture();


    $facture->date_facture = $request->date_facture;
    $facture->destinataire = $request->destinataire;

    $facture->code_destinataire = $request->code_destinataire;
    $facture->adresse = $request->adresse;
    $facture->devise1 = $request->devise;
    $facture->cours1 = $request->cours1;
    $facture->sigle = $request->sigle;
    $facture->incoterm = $request->incoterm;
    $facture->mode_paie = $request->mode_paie;
    $facture->poids_net = $request->poids_net;
    $facture->poids_brut = $request->poids_brut;
    $facture->matricule = $request->matricule;
    $facture->nbr_colid = $request->nbr_colid;
    $facture->montant = $request->montant;
    //************************************************* */

    $facture->code_ngp = $request->code_ngp;
    $facture->code_article = $request->code_article;
    $facture->designation = $request->designation;
    $facture->pays = $request->pays;
    $facture->unite = $request->unite;
    $facture->qte = $request->qte;
    $facture->Poids_net_artcl = $request->Poids_net_artcl;
    $facture->val_devise = $request->val_devise;
     


    // foreach ($data as $article) {
    //     $this->somme_net = $this->somme_net + $article['poids_net'];
    //     $this->somme_valeur_devise = $this->somme_valeur_devise + $article['valeur_devise'];
    // }
    // if ($request->poids_net != $this->somme_net) {
    //     //errreuuuuuuur
    //     // return view('livewire.add-line-article' ,['id_dossier'=> $request->input('id1')]);
    // }
    // if ($request->val_devise != $this->somme_valeur_devise) {
    //     //erreeuuer
    // }

    $facture->save();
    // }

    $id_dossier = decrypt($request->input('id1'));
    DB::table('facture_dossier')->insert([
        'id_facture' => $facture->id,
        'id_dossier' => $id_dossier
    ]);


    foreach ($data as $article) {
        $unt = unityMesure::select('Id_Unite_Mesure')->where('Code_Unite', $article['Unite_Mesure'])
            ->get();
        $ngp = DB::table('nomenclature')
            ->select('Id_Nomenclature')->where('Code_Nomenclature', $article['code_ngp'])
            ->get();
        $artcl = DB::table('article')
            ->select('Id_Article')
            ->where('Code_Article', $article['code_article'])
            ->get();

        DB::insert('insert into ligne_article (designation, id_unite, qte,id_facture,id_code_ngp,id_code_article,
        pays,poids_net,valeur_devise) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [
                $article['designation'],
                $unt[0]->Id_Unite_Mesure,
                $article['Qte'], $facture->id,
                $ngp[0]->Id_Nomenclature, $artcl[0]->Id_Article, $article['pays'], $article['poids_net']
                , $article['valeur_devise']
            ]
        );

    }
    // if ($this->check == 0) {
    //     $dossier = Dossier::find($id_dossier);
    //     return view('/addFacture', ['id1' => Crypt::encrypt($id_dossier)]);
    // } else if ($this->check == 1) {
        $dossier = Dossier::find($id_dossier);
        $facture = Dossier::find($id_dossier)
            ->leftJoin('facture_dossier', 'dossiers.id', '=', 'facture_dossier.id_dossier')
            ->leftJoin('factures', 'facture_dossier.id_facture', '=', 'factures.id')
            ->where('dossiers.id', $id_dossier)
            ->select('factures.*')
            ->get();
           
        return view("showDossier", ['dossier' => $dossier, 'factures' => $facture]);
    // }
    }
    
   
    public function render()
    {
        $devise = devise::all();
        $incoterm = incoterm::all();


        return view('livewire.add-line-article', compact('devise', 'incoterm'));
    }






}
