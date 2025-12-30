<?php

namespace App\Http\Livewire;

use App\Models\Ventillation;
use Livewire\Component;
use App\Http\Controllers\FactureController;
use App\Models\Dossier;
use App\Models\Facture;
use App\Models\LigneArticle;
use App\Models\UnityMesure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FactureModifierComponent extends Component
{public $designation ;
    public $Qte ;
    public $unityMesureSearch ;
    public $code_ngp;
    public $code_article;
    public $pays;
    public $poids_net;
    public $valeur_devise;
    public $data = [] ;
    public $Code_Unite;
    public $records;
    public $showdiv = false;
    public $id1 ;
    public $dossier ;
    public $factures ;
    public $articles ;
    public $newItem;
    public $check ;
    public $count ;
    
    //  public function index()
    //  {
        
    //  }
    public function __construct()
    {
        $this->count =0 ;
        //dd($this->count);
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
    
    
    public function removeItem($index)
    {
        unset($this->data[$index]);
        Session::put('data', $this->data);
    }
    
  public function store()
     {
    
         $this->data[] = [
           'designation' => $this->designation ,
         
            'Unite_Mesure' =>$this->unityMesureSearch,
            'Qte' =>$this->Qte ,
            'code_ngp'=>$this->code_ngp ,
          
           'code_article'=>$this->code_article,
    
            'pays'=>$this->pays,       
            'poids_net'=>$this->poids_net,
            'valeur_devise'=>$this->valeur_devise,
        ];
        Session::put('data', $this->data);
    
        if ($this->newItem) {
            $this->data[] = $this->newItem;
            $this->newItem = '';
        }
         session()->flash('message', 'Articles have been created successfully.');
    }
    
         public function save(Request $request)
        {  
            
    
            if(isset($_POST['ajouter_facture']))
            {
              $this->check = 0 ;  
            }
            else if(isset($_POST['valide']))
            {
                $this->check= 1 ;
            }
            $data = Session::get('data');
            
    
            $facture = new Facture();
           
           
            $facture->date_facture = $request->date_facture ;
            $facture->destinataire = $request->destinataire ;
    
            $facture->code_destinataire = $request->code_destinataire ;
            $facture->adresse = $request->adresse ;
            $facture->devise1 =  $request->devise1 ;
            $facture->cours1 = $request->cours1 ;
            $facture->sigle = $request->sigle ;
            $facture->incoterm = $request->incoterm ;
            $facture->mode_paie = $request->mode_paie ;
             $facture->poids_net= $request->poids_net;
             $facture->poids_brut = $request->poids_brut;
            $facture->matricule = $request->matricule ;
            $facture->nbr_colid = $request->nbr_colid ;
            $facture->montant = $request->montant ;
            //************************************************* */
    // a retirer
            $facture->code_ngp = $request->code_ngp ; 
            $facture->code_article = $request->code_article ; 
            $facture->designation = $request->designation ;
            $facture->pays = $request->pays ;
            $facture->unite = $request->unite ; 
            $facture->qte = $request->qte ;
            $facture->Poids_net_artcl = $request->Poids_net_artcl ;
            $facture->val_devise = $request->val_devise ; 
            $facture->save();
         
       
           $id_dossier = decrypt($request->input('id1'));
            DB::table('facture_dossier')->insert([
                'id_facture' => $facture->id,
                'id_dossier' => $id_dossier
            ]);
           
         
            foreach ($data as $article) {
                 $unt=unityMesure::select('Id_Unite_Mesure')->where('Code_Unite', $article['Unite_Mesure'])
                 ->get();
                 $ngp = DB::table('nomenclature')
                 ->select('Id_Nomenclature')->where('Code_Nomenclature', $article['code_ngp'])
                 ->get(); 
                $artcl = DB::table('article')
                ->select('Id_Article')
                ->where('Code_Article',$article['code_article'])
                ->get(); 
    
             DB::insert('insert into ligne_article (designation, id_unite, qte,id_facture,id_code_ngp,id_code_article,
                pays,poids_net,valeur_devise) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                 [$article['designation'], 
                  $unt[0]->Id_Unite_Mesure,
                  $article['Qte'] , $facture->id ,
                  $ngp[0]->Id_Nomenclature ,$artcl[0]->Id_Article,$article['pays'],$article['poids_net']
            ,$article['valeur_devise']]);
                
            }
            if( $this->check == 0)
            {
                return view('/addFacture', ['id1' => Crypt::encrypt($id_dossier)]);
            }
            else if($this->check== 1)
            {  $dossier = Dossier::find($id_dossier) ;
                $facture = Dossier::find($id_dossier)
                ->leftJoin('facture_dossier', 'dossiers.id', '=', 'facture_dossier.id_dossier')
                ->leftJoin('factures', 'facture_dossier.id_facture', '=', 'factures.id')
                ->where('dossiers.id', $id_dossier) 
                ->select('factures.*')
                ->get();
                return view("showDossier", ['dossier'=>$dossier , 'factures'=>$facture]);
            }
        }
      public function saveModification(Request $request)
        {
           $data = Session::get('data');
                DB::update('update factures set date_facture = ?,destinataire=?,code_destinataire=?,adresse=? , devise1 = ? ,cours1 = ? , sigle = ? ,incoterm = ? , mode_paie = ? , poids_net = ? ,poids_brut=? , matricule=? ,nbr_colid=? ,montant = ? where id = ?',
            [$request->date_facture,$request->destinataire ,$request->code_destinataire
           , $request->adresse,$request->devise1,$request->cours1,$request->sigle,
           $request->incoterm ,$request->mode_paie ,$request->poids_net
        ,$request->poids_brut,$request->matricule ,$request->nbr_colid ,$request->montant ,decrypt($request->idFacture)]);
           DB::table('ligne_article')->where('id_facture',decrypt($request->idFacture))->delete();
           foreach ($data as $article) {
            $unt=DB::table('unite_mesure')
            ->where('Code_Unite',$article['Unite_Mesure'] )
            ->first();
              
                $ngp = DB::table('nomenclature')
                ->where('Code_Nomenclature',$article['code_ngp'] )
                ->first();  
                $artcl = DB::table('article')
                ->where('Code_Article',$article['code_article'])
                ->first();     
            DB::insert('insert into ligne_article (designation, id_unite, qte,id_facture,id_code_ngp,id_code_article,
                                pays,poids_net,valeur_devise) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
                                 [$article['designation'], 
                                  $unt->Id_Unite_Mesure,
                                  $article['Qte'] , decrypt($request->idFacture) ,
                                  $ngp->Id_Nomenclature ,$artcl->Id_Article,$article['pays'],$article['poids_net']
                            ,$article['valeur_devise']]);
           }
           $id = decrypt($request->idFacture);
           Ventillation::where('id_facture','LIKE', '%' . $id. '%')->delete();//the last change
           
    $facture = Facture::find($id) ;
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



       return view('showFacture', ['factures' => $facture , 'articles'=>$articles ,'dossier'=>$dossier]);
        }
       
    public function render()
    {
      
         $this->count ++ ;
        if($this->count == 1)
        {
            foreach($this->articles as $article) {
                $unt=unityMesure::select('Code_Unite')->where('Id_Unite_Mesure',$article->id_unite )
                ->first();
               
                 $ngp = DB::table('nomenclature')
                ->where('Id_Nomenclature',$article->id_code_ngp)
                ->first();
                $artcl = DB::table('article')
                 ->where('Id_Article',$article->id_code_article)
                 ->first(); 
                 
                $this->data[] = [
                    'designation' => $article->designation,
                    'Unite_Mesure' =>$unt['Code_Unite'] ,
                    'Qte' => $article->qte,
                    'code_ngp' => $ngp->Code_Nomenclature ,
                    'code_article' => $artcl->Code_Article,
                    'pays' => $article->pays,
                    'poids_net' => $article->poids_net,
                    'valeur_devise' => $article->valeur_devise,
                ];
            }
         
          
                return view('livewire.facture-modifier-component',['data'=>$this->data]);
        }
        else if($this->count > 1)
        {
            return view('livewire.facture-modifier-component',['data'=>$this->data]);
        }
       
        
    }


}
//      DB::update('update factures set date_facture = ?,destinataire=?,code_destinataire=?,adresse=? , devise1 = ? ,cours1 = ? , sigle = ? ,incoterm = ? , mode_paie = ? , poids_net = ? ,poids_brut=? , matricule=? ,nbr_colid=? ,montant = ? where id = ?',
    //         [$request->date_facture,$request->destinataire ,$request->code_destinataire
    //        , $request->adresse,$request->devise1,$request->cours1,$request->sigle,
    //        $request->incoterm ,$request->mode_paie ,$request->poids_net
    //     ,$request->poids_brut,$request->matricule ,$request->nbr_colid ,$request->montant ,decrypt($request->idFacture)]);
        // $data = Session::get('data');
      //   dd($data);
    //     DB::table('ligne_article')->where('id_facture',decrypt($request->idFacture))->delete();
    //     foreach ($data as $article) {
          
    //                     //  $unt=unityMesure::select('Id_Unite_Mesure')->where('Code_Unite', $article['Unite_Mesure'])
    //                     //  ->get();
                        
    //                     //  $ngp = DB::table('nomenclature')
    //                     //  ->select('Id_Nomenclature')->where('Code_Nomenclature', $article['code_ngp'])
    //                     //  ->get(); 
    //                     // $artcl = DB::table('article')
    //                     // ->select('Id_Article')
    //                     // ->where('Code_Article',$article['code_article'])
    //                     // ->get(); 
    //                 // dd($article['designation']);
                  
    //                  DB::insert('insert into ligne_article (designation, id_unite, qte,id_facture,id_code_ngp,id_code_article,
    //                     pays,poids_net,valeur_devise) values (?, ?, ?, ?, ?, ?, ?, ?, ?)',
    //                      [$article['designation'], 
    //                      $article['Unite_Mesure'],
    //                       $article['Qte'] , decrypt($request->idFacture) ,
    //                       $article['code_ngp'] ,$article['code_article'],$article['pays'],$article['poids_net']
    //                 ,$article['valeur_devise']]);
                        
    //                 }