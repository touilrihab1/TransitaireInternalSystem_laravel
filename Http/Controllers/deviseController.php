<?php

namespace App\Http\Controllers;

use App\Models\devise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class deviseController extends Controller
{
 
    public function store(Request $request)
    {
       
      $devise = new devise() ;
      $devise->Code_Devise =$request->codeDevise ;
      $devise->Cours = $request->coursDevise ;
      $org = $devise->save() ;
      if ($org) {
        Session::flash('success', 'Record added successfully.');
    } else {
        Session::flash('error', 'Record not added.');
    }
      return redirect()->route('devise.show');
    }
    public function delete(Request $request)
    {
        $org = devise::find($request->input('ido'));
        if ($org) {
            $org->delete();
            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }
        return redirect()->back();
    }
    public function show()
    {
        $devise = devise::paginate(10);
        return view('documents.devise', ['devise' => $devise]);
    }
    public function modifier(Request $request)
    {
        $id_devise =$request->ido2 ;
        $codeDevise = $request->codeDevise;
        $coursDevise =$request->coursDevise;
       $org =  devise::where('Id_Devise',$id_devise)
        ->update(['Code_Devise' =>$codeDevise , 'Cours'=>$coursDevise  ]);
        if ($org) {
            Session::flash('success', 'Record modified successfully.');
        } else {
            Session::flash('error', 'Record not modified.');
        }
        return redirect()->route('devise.show');
    }
}
