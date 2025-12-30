<?php

namespace App\Http\Controllers;

use App\Models\origin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;


class originController extends Controller
{
    public function index(): View
    {
        return view('documents.origin', [
            'origine' => DB::table('origine')->paginate(8)
        ]);


    }


    public function store(Request $request)
    {
        
        DB::table('origine')->insert([
            'Code_Origine' => $request->codeOrigin,
            'Intitule_Origine' => $request->intituleOrigine
        ]);
        return redirect()->route('origin.index');
    }
   
    public function delete(Request $request)
    {
        $org = origin::find($request->input('ido'));
        if ($org) {
            $org->delete();
            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }
        return redirect()->back();
    }

    public function modifier(Request $request)
    {
        $id = $request->ido1;
        DB::table('origine')->where('Id_Origine',$id)
        ->update(['Code_Origine' =>$request->codeOrigin ,'Intitule_Origine' => $request->intituleOrigine ]);
        return redirect()->route('origin.index');
    }
}
