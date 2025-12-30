<?php

namespace App\Http\Livewire;

use App\Models\ChargeDossier;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Request;

use \Illuminate\Support\Facades\DB ;
class ChargeList extends Component
{
    public $idaze;
    public $departements;

    public $deleteId = '';




    public function deleteId($id)
    {

        $this->deleteId = $id;

    }

    /**
     * Write code on Method
     *
     */
    public function delete()
    {
        //Log::info('An informational message.');
        ChargeDossier::find($this->deleteId)->delete();
        session()->flash('success', 'Charge deleted successfully ');
    }


    public function render(Request $request)
    {

        $id_crypte = $this->idaze;
        $id_decrypte = decrypt($id_crypte);
        $charges =DB::table('charge_dossier')->where('id_dossier',$id_decrypte)
        ->join('charge','charge_dossier.id_charge','charge.Id_Charge')
        ->get() ;
       
        return view('livewire.charge-list', compact('charges'));
    }

}
