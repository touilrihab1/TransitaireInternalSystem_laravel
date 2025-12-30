<?php

namespace App\Http\Livewire;

use App\Models\arrondissement;
use App\Models\bureauDouanier;
use App\Models\Client;
use App\Models\destination;
use App\Models\devise;
use App\Models\Dossier;
use App\Models\Dum;
use App\Models\regime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;
use Kyslik\ColumnSortable\Sortable;
class BureauD extends Component
{
    public $code_b;
    public $code_a;
    public $intitule_b;
    public $intitule_a;
    public $code;
    public $bureau_d;

    public $showdiv = false;
    public $showdiv_arrondissement = false;
    public $showdiv_regime = false;
    public $showdiv_dest = false;
    public $search = "";
    public $search_arrondissement = "";
    public $search_regime = "";
    public $search_dest = "";
    public $records;
    public $records_arrondissement;
    public $records_regime;
    public $records_dest;
    public $Intitule_Regime;
    public $intitule_designation;
    //--------------client----------------------//
    public $selectedClientId;

    public $Code_Tiers;
    public $Adresse;
    public $Ville;
    public $Raison_Sociale;

    public $id_dossier;


    public $showdiv_raison = false;
    public $search_raison = "";
    public $records_raison;
    public $empDetails;


    public $num_dum = ''; // Livewire property to store the value of "Num_dum" input
    public $selectedCodeBureau = '';
    public $selectedArrondissement = '';
    public $selectedRegime = '';
    public $serie;
    public $lettre;
    public $selectedDevise;
    public $cours;
    public function updatedSelectedDevise($value)
    {
        $devise = Devise::where('Code_Devise', $value)->first();

        if ($devise) {
            $this->cours = $devise->Cours;
        } else {
            $this->cours = null;
        }
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Perform the search query using the input value
        $bureauDouanier = bureauDouanier::where('code', 'like', "%$search%")
            ->orWhere('bureau_d', 'like', "%$search%")
            ->paginate(10);

        return view('tableBureau', ['bureau_douanier' => $bureauDouanier]);
    }
    public function searchResult()
    {
        if (!empty($this->search)) {    
            $this->records = bureauDouanier::orderBy('code', 'asc')
                ->select('code', 'bureau_d')
                ->where('code', 'like', $this->search . '%')
                ->limit(10)
                ->get();
            $this->showdiv = true;
        } else {
            $this->showdiv = false;
        }
    }

    public function fetchEmployeeDetail($code = 0)
    {
        $record = bureauDouanier::select('*')
            ->where('code', $code)
            ->first();

        if ($record) {
            $this->search = $record->code . '-' . $record->bureau_d;
            $this->bureau_d = $record->bureau_d;
        } else {
            $this->search = "";
            $this->bureau_d = "";
        }

        $this->showdiv = false;

        $this->selectedCodeBureau = $code; // Assign the selected code to the property
        $this->updateNumDum(); // Call the method to update the "Num_dum" value
    }

    public function index()
    {

       $bureau_douanier = bureauDouanier::sortable()->paginate(10);
       return view('tableBureau', ['bureau_douanier' => $bureau_douanier]);
    
    }
    public function store(Request $request)
    {
        $bureau = new bureauDouanier();
        $bureau->code = $request->codeBureau;
        $bureau->bureau_d = $request->bureauDouanier;
        $result = bureauDouanier::find($request->codeBureau);
        if($result){
            Session::flash('error', 'Code bureau exist.');
        }
        else{
          $bureau->save();  
        }
        

        return redirect()->route('bureau.index');
    }
    public function modifier(Request $request)
    {
        $id = $request->idb;
        bureauDouanier::where('code', $id)
            ->update(['code' => $request->codeBureau, 'bureau_d' => $request->bureauDouanier]);


        return redirect()->route('bureau.index');
    }
    //-------------------------------------------------------------------------------------//
    public function searchResult1()
    {
        if (!empty($this->search_arrondissement)) {
            $this->records_arrondissement = arrondissement::orderBy('code_a', 'asc')
                ->select('code_a', 'code_b', 'intitule_a')
                ->where('code_a', 'like', $this->search_arrondissement . '%')
                ->limit(10)
                ->get();
            $this->showdiv_arrondissement = true;
        } else {
            $this->showdiv_arrondissement = false;
        }
    }
    public function fetchEmployeeDetail1($code_a = 0)
    {
        $record1 = arrondissement::where('code_a', $code_a)->first();

        if ($record1) {
            $this->search_arrondissement = $record1->code_b . '-' . $record1->intitule_a;
            $this->intitule_a = $record1->intitule_a;
        } else {
            $this->search_arrondissement = "";

        }

        $this->showdiv_arrondissement = false;
        $this->selectedArrondissement = $code_a; // Assign the selected code to the property
        $this->updateNumDum(); // Call the method to update the "Num_dum" value
    }

    public function show1()
    {
        $arrond = arrondissement::all();
        return view('tableArrond', ['arrondissement' => $arrond]);
    }
    //------------------------------------------regime----------------------------------//

    public function searchRegime()
    {
        if (!empty($this->search_regime) || str_starts_with($this->search_regime, '0')) {
            $this->records_regime = regime::orderBy('Code_Regime', 'asc')
                ->select('Id_Regime', 'Code_Regime', 'Intitule_Regime')
                ->where('Code_Regime', 'LIKE', "$this->search_regime" . '%')
                ->limit(11)
                ->get();
            $this->showdiv_regime = true;
        } else {
            $this->showdiv_regime = false;
        }
    }

    public function fetchRecord(string $Code_Regime = 'default')
    {
        // dd($Code_Regime);
        $recordR = regime::where('Code_Regime', $Code_Regime)->first();

        if ($recordR) {
            $this->search_regime = $recordR->Code_Regime . '-' . $recordR->Intitule_Regime;
            $this->Intitule_Regime = $recordR->Intitule_Regime;
        } else {
            $this->search_regime = "";
        }

        $this->showdiv_regime = false;
        $this->selectedRegime = $Code_Regime; // Assign the selected code to the property
        $this->updateNumDum(); // Call the method to update the "Num_dum" value

    }

    public function submitForm()
    {
        // Access the values of "serie" and "letter" here
        // Reset the form fields


        $this->serie = '';
        $this->lettre = '';
        $this->updateNumDum(); // Call the method to update the "num_dum" value

    }

    public function updateNumDum()
    {
        $this->num_dum = $this->selectedCodeBureau . $this->selectedRegime . '2023' . $this->serie . $this->lettre;
        session()->put('num_dum', $this->num_dum);
    }


    //-------------------------------bureau-destination---------------------------------//

    public function searchDest()
    {
        if (!empty($this->search_dest)) {
            $this->records_dest = destination::orderBy('code_stockage', 'asc')
                ->select('code_bureau', 'code_stockage', 'intitule_designation')
                ->where('code_stockage', 'like', $this->search_dest . '%')
                ->limit(10)
                ->get();
            $this->showdiv_dest = true;
        } else {
            $this->showdiv_dest = false;
        }
    }
    public function fetchDest($code_stockage = 0)
    {
        $recordR = destination::where('code_stockage', $code_stockage)->first();

        if ($recordR) {
            $this->search_dest = $recordR->code_stockage . '-' . $recordR->intitule_designation;
            $this->intitule_designation = $recordR->intitule_designation;
        } else {
            $this->search_dest = "";

        }

        $this->showdiv_dest = false;

    }
    //--------------------------------------client----------------------------------------------//
    public function searchResultR()
    {
        if (!empty($this->search_raison)) {

            $this->records_raison = Client::orderby('Raison_Sociale', 'asc')
                ->select('*')
                ->where('Raison_Sociale', 'like', $this->search_raison . '%')
                ->limit(5)
                ->get();

            $this->showdiv_raison = true;

        } else {
            $this->showdiv_raison = false;
        }
    }

    // Fetch record by ID
    public function fetchRaisonDetail($id = 0)
    {

        $record = Client::select('*')
            ->where('Id', $id)
            ->first();

        $this->search_raison = $record->Raison_Sociale;
        $this->showdiv_raison = false;
        $this->fetchClientDetail($id);


    }

    public function fetchClientDetail($id = 0)
    {
        $record = Client::find($id);
        // dd($record);
        if ($record) {
            // $this->code_client = $record->code_client;
            $this->Code_Tiers = $record->Code_Tiers;

            $this->Adresse = $record->Adresse;
            $this->Ville = $record->Ville;
            $this->Raison_Sociale = $record->Raison_Sociale;
        }

    }
    //---------------save---------------//
    // public function getId(Request $request)
    // {
    //     $devise = DB::table('devise')->select('Code_Devise', 'Intitule_Devise')->get();
    //   //  $id_dossier = $request->id1 ;
    //    // return view('formulaire1', ['id_dossier' => $id_dossier ,'devise'=>$devise]);
    //     return view('formulaire1');
    // }

   

    public function delete(Request $request)
    {
        $org = bureauDouanier::find($request->input('ido'));
        if ($org) {
            $org->delete();
            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }
        return redirect()->back();
    }

    public function render()
    {
        $devise = devise::all();
        return view('livewire.bureau-d', ['devise' => $devise]);

    }
}