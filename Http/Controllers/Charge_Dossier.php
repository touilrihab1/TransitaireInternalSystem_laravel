<?php

namespace App\Http\Controllers;

use App\Models\charge;
use App\Models\ChargeDossier;
use App\Models\Dossier;
use Filament\Forms\Components\Select;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Charge_Dossier extends Controller
{
    public function getChargeForm(Request $request)
    { 
        if(isset($request->id1))
        {
          $ida = $request->id1; 
        }
        else
        {
          $ida =  $request->id;
        }
        $id = decrypt($ida);
        $dossier = Dossier::find($id);
      
        $id_crypte = Crypt::encrypt($id);
        $charge = charge::all() ;
        
       // $charge = DB::table('charge')->select('Designation_Charge')->get() ;
         return view('addCharge', compact('charge'), ['idaze' => $id_crypte , 'num'=>$dossier->n_dossier]);
    }
    public function save(Request $request)
    {
      if(auth()->user()->hasRole('exploitation')){
        $valeur_charge = $request->valeur_charge ;
        $serie_facture = $request->serie_facture ;
        $id_charge = $request->input('type');
         $id_dossier = decrypt($request->id)  ;
         $charge = new ChargeDossier() ;
         $charge->id_dossier = $id_dossier ;
         $charge->id_charge = $id_charge ;
         $charge->valeur = $valeur_charge ;
         $charge->serie_facture = $serie_facture;
         $charge->save() ;
     
        return $this->getChargeForm($request) ;
      }
    }
}
