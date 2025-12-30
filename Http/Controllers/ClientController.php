<?php

namespace App\Http\Controllers;

use App\Exports\ClientExport;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\origin;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::paginate(5);


        return view('allClient', compact('clients'));
    }


    public function fetchOrigine()
    {
        $origines = origin::all('Intitule_Origine')->pluck('Intitule_Origine');

        return response()->json($origines);
    }


    public function searchClients(Request $request)
    {
        $search = $request->input('search');
        $clients = Client::where('Raison_Sociale', 'LIKE', $search . '%')->paginate(10);

        return view('allClient')->with('clients', $clients);
    }


    public function save(Request $request)
    {
   
        $request->validate([
            'email' => 'required|email|unique:clients,email',           

        ]);

        $cli = new Client();
        $cli->Code_Tiers = $request->Code_Tiers;
        $cli->Raison_Sociale = $request->Raison_Sociale;
        // $cli->type_client = $request->type_client;
        $cli->Adresse = $request->Adresse;
        $cli->Code_Postale = $request->Code_Postale;
        $cli->Ville = $request->Ville;
        $cli->Pays = $request->Pays;
        $cli->NUM_EACCE1 = $request->NUM_EACCE1;
        $cli->NUM_EACCE2 = $request->NUM_EACCE2;
        $cli->NUM_EACCE3 = $request->NUM_EACCE3;
        $cli->Num_RC = $request->Num_RC;
        $cli->ice = $request->ice;
        $cli->periode_paiement = $request->periode_paiement ;
        $cli->Num_Centre = $request->Num_Centre;
        $cli->Tel1 = $request->Tel1;
        $cli->Tel2 = $request->Tel2;
        $cli->Fax = $request->Fax;
        $cli->email = $request->email;

        $cli->save();

        return redirect('/addClient')->with('status', 'Client a été ajouté avec succès !');
    }

    public function show()
    {
        $clients = Client::all()
            ->where('Id', '>', '2');
        return view('allClient', ['clients' => $clients]);
    }
    public function modifier()
    {

    }

    //----------------------export excel---------------------//
    public function export()
    {
        return Excel::download(new ClientExport, 'listClinet.xlsx');
    }

}