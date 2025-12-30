<?php

namespace App\Http\Livewire;

use App\Models\Affectation;
use App\Models\Dossier;
use App\Models\TypeFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class AffecterButton extends Component
{

    public $idaze;
    public $ide;
    public $departements = [];
    public $id_roles = [];
    public static $count = 10;

    public function render(Request $request)
    {
        // echo $this->affecterGetId();
        $this->departements = Role::where('id', '!=' ,4)
        ->where('id', '!=' ,1)
        ->get();
        self::$count++;
        return view('livewire.affecter-button');
    }

    public function affecter(Request $request)
    {
        // dd($this->idaze);
        $id = $request->input('ida');

        // dd(decrypt($id));

        //   Crypt::encrypt($id);

        $id_dossier = decrypt($id);
        $dossier = Dossier::find($id_dossier);

        $id_roles = $request->input('departement');
        $obsevation = $request->input('observation');
        $dossier11 = DB::table('affectation')->where('id_dossier', $id_dossier)->first();
        if ($dossier11) {
            $assigned_roles = Affectation::where('id_dossier', $id_dossier)->pluck('id_role')->toArray();
            foreach ($id_roles as $role_id) {
                if (!in_array($role_id, $assigned_roles)) {
                    $affectation = DB::table('affectation')
                        ->where('id_dossier', $id_dossier)
                        ->update(['id_role' => $role_id, 'observation' => $obsevation]);
                }
            }
        } else {
            $assigned_roles = Affectation::where('id_dossier', $id_dossier)->pluck('id_role')->toArray();
            foreach ($id_roles as $role_id) {
                if (!in_array($role_id, $assigned_roles)) {
                    $affectation = new Affectation();
                    $affectation->id_dossier = $id_dossier;
                    $affectation->id_role = $role_id;
                    $affectation->observation = $obsevation;
                    $affectation->save();
                }
            }
        }

        session()->flash('success', 'Le département a été affecté avec succès!');

        $idaze = Crypt::encrypt($id_dossier);
        $types = TypeFile::pluck('type', 'id');
        //-----------------------------------Tracking-------------------------
        if (DB::table('affectation')->select('id_role')->where('id_dossier', $id_dossier)->first()->id_role == 3) {
            DB::insert('insert into dossier_tracking (id_dossier, id_statut ,created_at) values (?, ?, ?)', [$id_dossier, 54, Carbon::now()]);
        } else if (DB::table('affectation')->select('id_role')->where('id_dossier', $id_dossier)->first()->id_role == 2) {
            DB::insert('insert into dossier_tracking (id_dossier, id_statut ,created_at) values (?, ?, ?)', [$id_dossier, 50, Carbon::now()]);
        }


        // return view('file-upload', compact('types'), ['idaze' => $idaze, 'num' => $dossier->n_dossier]);
        return back()->with(['idaze' => $idaze, 'num' => $dossier->n_dossier]);

    }

    public function affecterGetId()
    {

        return decrypt($this->idaze);

    }



// private function getAffectations()
// {
//     $id_decrypte = decrypt($this->idaze);
//     return DB::table('affectation')
//         ->join('roles', 'roles.id', '=', 'affectation.id_role')
//         ->where('id_dossier', $id_decrypte)
//         ->select('affectation.*', 'roles.name')
//         ->get();
// }
}