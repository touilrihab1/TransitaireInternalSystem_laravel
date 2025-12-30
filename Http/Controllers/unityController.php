<?php

namespace App\Http\Controllers;

use App\Models\unityMesure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class unityController extends Controller
{
    public $deleteId = '';



    /**
     * Show the form for creating a new resource.
     */
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $unite = new unityMesure() ;
        $unite->Code_Unite = $request->codeUnite;
        $unite->Intitule_Unite = $request->intituleunite ;
        $n = $unite->save() ;
        if ($n) {
            $msg = 'unite mesure entry created successfully.';
        } else {
            $msg = 'unite mesure data is updated successfully';
        }
        return redirect()->route('unite.show')->with('success', $msg);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $unite_mesure1 = unityMesure::paginate(10);
        return view('documents.uniteMesure', ['unite_mesure' => $unite_mesure1]);
    }

    public function delete(Request $request)
    {
        $unit = unityMesure::find($request->input('idm'));
        if ($unit) {
            $unit->delete();
            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }
        return redirect()->back();
    }
    public function modifier(Request $request)
    {
        $id_unite =$request->newId2 ;
        $codeUnite = $request->codeUnite;
        $intituleunite =$request->intituleunite;
       $org =  unityMesure::where('Id_Unite_Mesure',$id_unite)
        ->update(['Code_Unite' =>$codeUnite , 'Intitule_Unite'=>$intituleunite  ]);
        if ($org) {
            Session::flash('success', 'unite mesure entry modifid successfully.');
           
        } else {
            Session::flash('error', 'Record not found.');
        }
        return redirect()->route('unite.show');
    }
}

