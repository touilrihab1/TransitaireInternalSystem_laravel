<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\devise;
use App\Models\Dossier;
use App\Models\FactureFinal_dossier;
use App\Models\FactureFinal_mensuelle;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PDF;
use Illuminate\Http\Response;

class FactureFinalDossier extends Controller
{
    public function index()
    {
        $factures = FactureFinal_dossier::leftjoin('dossiers', 'factureFinal_dossier.id_dossier', 'dossiers.id')
            ->leftjoin('clients', 'factureFinal_dossier.id_client', 'clients.Id')
            ->select('factureFinal_dossier.*', 'dossiers.n_dossier', 'dossiers.id', 'clients.Code_Tiers', 'clients.Raison_Sociale')
            ->get();

        $devises = devise::all();
        return view('tableFacture', ['factures' => $factures, 'devises' => $devises]);
    }

    public function Invoice(Request $request)
    {
        $valeur_net = 0;
        $devise = devise::find($request->type);
        $num_dossier = $request->num_dossier;
        $dossier_id = Dossier::where('n_dossier', $num_dossier)
            ->select('dossiers.id', 'dossiers.expediteur')
            ->first();
        $client_id = Client::where('Raison_Sociale', $dossier_id->expediteur)
            ->select('clients.id')
            ->first();
        $client = Client::where('Id', $client_id->id)
            ->first();

        $charges = DB::table('charge_dossier')
            ->where('charge_dossier.id_dossier', $dossier_id->id)
            ->leftJoin('charge', 'charge_dossier.id_charge', '=', 'charge.Id_Charge')

            ->select('charge_dossier.*', 'charge.Designation_Charge')
            ->get();

        // dd($valeur_net );
        //  $valeur_net  = $valeur_net + number_format($charges[0]->valeur/$devise->Cours, 2) ;

        //  dd( $valeur_net + number_format($charges[1]->valeur/$devise->Cours, 2));


        $facture = DB::table('facturefinal_dossier')->where('id_dossier', $dossier_id->id);

        if ($facture->get()->count() == 0) {

            foreach ($charges as $charge) {
                $valeur_net = $valeur_net + $charge->valeur;

            }

            DB::insert(
                'insert into facturefinal_dossier (id_dossier , id_client ,valeur_net ,etat,created_at) values (?, ?, ?, ?, ?)',
                [$dossier_id->id, $client_id->id, $valeur_net, 'non payé', Carbon::now()]
            );
            $num = sprintf("%05d", $facture->first()->id);
            $facture->update(['num_facture' => 'D' . date("Y", strtotime(Carbon::now())) . $num]);
            ;
            $valeur_net = $valeur_net / $devise->Cours;
            $valeur_net = number_format($valeur_net, 2);
            $pdf = PDF::loadView('invoice_pdf', ['charges' => $charges, 'valeur_net' => $valeur_net, 'devise' => $devise, 'facture' => $facture->first(), 'client' => $client]);
        } else {
            foreach ($charges as $charge) {
                $valeur_net = $valeur_net + $charge->valeur / $devise->Cours;

            }
            $valeur_net = number_format($valeur_net, 2);
            $pdf = PDF::loadView('invoice_pdf', ['charges' => $charges, 'valeur_net' => $valeur_net, 'devise' => $devise, 'facture' => $facture->first(), 'client' => $client]);

        }



        return $pdf->download('Facture.pdf');


    }
    public function indexMens()
    {
        $factures = FactureFinal_mensuelle::leftjoin('clients', 'facturefinal_mensuelle.id_client', 'clients.Id')
            ->select('facturefinal_mensuelle.*', 'clients.Code_Tiers', 'clients.Raison_Sociale')
            ->get();

        $devises = devise::all();
        return view('tableFactureMens', ['factures' => $factures, 'devises' => $devises]);
    }
    public function InvoiceMens(Request $request)
    {
        $valeur_net = 0;
        $devise = devise::find($request->type);
        $code_tiers = $request->codeTiers;
        $mois = $request->mois;
        $client = Client::where('Code_Tiers', $code_tiers)
            ->first();
        $factures = DB::table('facturefinal_dossier')
            ->where('id_client', $client->Id)
            ->whereRaw('MONTH(created_at) = ?', [$mois])
            ->get();

        $facture = DB::table('facturefinal_mensuelle')->where('id_client', $client->Id)
            ->where('mois', $mois);

        if ($facture->get()->count() == 0) {
            foreach ($factures as $data) {
                $valeur_net = $valeur_net + $data->valeur_net;

            }

            DB::insert(
                'insert into facturefinal_mensuelle ( id_client ,valeur_net ,etat,mois,created_at) values (?, ?, ?, ?, ?)',
                [$client->Id, $valeur_net, 'non payé', $mois, Carbon::now()]
            );

            $num = sprintf("%05d", $facture->first()->id);
            $facture->update(['num_facture' => 'M' . date("Y", strtotime(Carbon::now())) . $num]);
            ;
            $valeur_net = $valeur_net / $devise->Cours;
            $valeur_net = number_format($valeur_net, 2);
            $pdf = PDF::loadView('invoiceMensuelle_pdf', ['factures' => $factures, 'valeur_net' => $valeur_net, 'devise' => $devise, 'facture' => $facture->first(), 'client' => $client]);
        } else {
            foreach ($factures as $data) {
                $valeur_net = $valeur_net + $data->valeur_net / $devise->Cours;

            }
            $valeur_net = number_format($valeur_net, 2);
            $pdf = PDF::loadView('invoiceMensuelle_pdf', ['factures' => $factures, 'valeur_net' => $valeur_net, 'devise' => $devise, 'facture' => $facture->first(), 'client' => $client]);

        }


        return $pdf->download('FactureMensuelle.pdf');

    // Session::flash($pdf, 'FactureMensuelle.pdf');
    // return view('/tableFacture') ;

    }

}