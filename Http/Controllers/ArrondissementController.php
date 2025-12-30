<?php

namespace App\Http\Controllers;

use App\Models\arrondissement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Kyslik\ColumnSortable\Sortable;
class ArrondissementController extends Controller
{
    public function index()
    {
        
        $arrond = arrondissement::sortable()->paginate(10);
        return view('tableArrond', ['arrondissement' => $arrond]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Perform the search query using the input value
        $arrondissement = arrondissement::where('code_a', 'like', "%$search%")
            ->orWhere('intitule_a', 'like', "%$search%")
            ->paginate(10);

        return view('tableArrond', ['arrondissement' => $arrondissement]);
    }
    public function delete(Request $request)
    {
        $nm = arrondissement::find($request->input('ido'));
        if ($nm) {
            $nm->delete();
            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }
        return redirect()->back();
    }
    public function store(Request $request)
    {
        $arrodissement = new arrondissement();
        $arrodissement->code_b = $request->codeBureau;
        $arrodissement->intitule_b = $request->bureauDouanier;
        $arrodissement->code_a = $request->codeArrondissement;
        $arrodissement->intitule_a = $request->intituleArrondissement;
        $n = $arrodissement->save();
        if ($n) {

            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }

        return redirect()->route('arrodissement.index');
    }
    public function modifier(Request $request)
    {
        $id = $request->newId2;
        $codeBureau = $request->codeBureau;
        $bureauDouanier = $request->bureauDouanier;
        $codeArrondissement = $request->codeArrondissement;
        $intituleArrondissement = $request->intituleArrondissement;
        $n = arrondissement::where('id', $id)
            ->update(['code_b' => $codeBureau, 'intitule_b' => $bureauDouanier, 'code_a' => $codeArrondissement, 'intitule_a' => $intituleArrondissement]);
        if ($n) {

            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }

        return redirect()->route('arrodissement.index');
    }
}