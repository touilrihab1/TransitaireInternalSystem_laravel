<?php

namespace App\Http\Controllers;

use App\Models\nomenclature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NomenclatureController extends Controller
{

    public function index(Request $request)
    {

        $nomenclature1 = nomenclature::sortable()->paginate(8);


        return view('documents.nomenclature.index', compact('nomenclature1'));
    }


    public function search(Request $request)
    {
        $search = $request->input('search');

        // Perform the search query using the input value
        $nomenclature = nomenclature::where('Code_Nomenclature', 'like', "%$search%")
            ->orWhere('Intitule_Nomenclature', 'like', "%$search%")
            ->paginate(8);

        return view('documents.nomenclature.index', ['nomenclature' => $nomenclature]);
    }

    /**
     * Show the form for creating a new nomenclature.
     */
    public function create()
    {
        return view('documents.nomenclature.create');
    }

    /**
     * Store a newly created nomenclature in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Code_Nomenclature' => 'required',
            'Intitule_Nomenclature' => 'required',
        ]);

        $nomenclature = nomenclature::create([
            'Code_Nomenclature' => $request->get('Code_Nomenclature'),
            'Intitule_Nomenclature' => $request->get('Intitule_Nomenclature'),
        ]);

        return redirect(route('documents.nomenclature.index'))->with('success', 'Nomenclature ajoutée avec succès');
    }


    /**
     * Display the specified nomenclature.
     */
    public function show($id)
    {
        // $nomenclature = nomenclature::findOrFail($id);
        $nomenclature = nomenclature::where('Id_Nomenclature', '=', $id)->first();



        return view('documents.nomenclature.show')->with('nomenclature', $nomenclature);
    }

    /**
     * Show the form for editing the specified nomenclature.
     */
    public function edit($id)
    {
        $nomenclature = nomenclature::findOrFail($id);
        // $nomenclature = nomenclature::select()->where('Id_Nomenclature', '=', $id)->first();


        return view('documents.nomenclature.edit')->with('nomenclature', $nomenclature);
    }

    /**
     * Update the specified nomenclature in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Code_Nomenclature' => 'required',
            'Intitule_Nomenclature' => 'required',
        ]);

        // $nomenclature = nomenclature::findOrFail($id);
        $nomenclature = nomenclature::where('Id_Nomenclature', '=', $id)->first();

        $nomenclature->Code_Nomenclature = $request->get('Code_Nomenclature');
        $nomenclature->Intitule_Nomenclature = $request->get('Intitule_Nomenclature');
        $nomenclature->update();

        return redirect(route('documents.nomenclature.index'));
    }
    public function modifier(Request $request)
    {
        $Id_Nomenclature = $request->ida;
        $Code_Nomenclature = $request->Code_Nomenclature;
        $Intitule_Nomenclature = $request->Intitule_Nomenclature;
        $Id_Nomenclature = nomenclature::where('Id_Nomenclature', $Id_Nomenclature)
            ->update(['Code_Nomenclature' => $Code_Nomenclature, 'Intitule_Nomenclature' => $Intitule_Nomenclature]);
        return redirect()->route('documents.nomenclature.index');
    }
    public function destroy(Request $request)
    {
        // $nomenclature = nomenclature::findOrFail($id);
        // $nomenclature = nomenclature::where('Id_Nomenclature', '=', $id)->first();

        // $nomenclature->delete();

        // return redirect(route('documents.nomenclature.index'));
        $nm = nomenclature::find($request->input('ida1'));
        if ($nm) {
            $nm->delete();
            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }
        return redirect()->back();
    }
}