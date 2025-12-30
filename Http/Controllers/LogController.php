<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use App\Models\Dossier;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Collection;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $sortable = app(Sortable::class);
        $sortable->appends($request->except('page'));

        $query = Log::join('users', 'logs.id_user', '=', 'users.id')
            ->join('dossiers', 'logs.id_dossier', '=', 'dossiers.id')
        
            ->select(
                'logs.*',
                'users.name as user_name',
                'users.email',
                'dossiers.n_dossier',
               
            );

        $traces = $sortable->apply($query)->paginate(5);

        return view('traceOper')
            ->with('traces', $traces)
            ->with('sortable', $sortable);
    }





    public function changeDevise(Request $request)
    {
        if (auth()->user()->hasPermissionTo('taux de change')) {
            $home = (new ChartJSController)->index();
            $cours = $request->valeurChange;
            $devise = $request->devise;

            DB::table('devise')->where('Code_Devise', $devise)
                ->update(['Cours' => $cours]);
            return $home;
        }
    }





    public function show(Request $request)
    {
        $query = $request->input('query');
        $traces = Log::join('users', 'logs.id_user', '=', 'users.id')
            ->join('dossiers', 'logs.id_dossier', '=', 'dossiers.id')
            ->select(
                'logs.*',
                'users.name as user_name',
                'users.email',
                'dossiers.n_dossier',
               
            )
            ->get();

        $dossiers = Dossier::where('n_dossier', 'LIKE', "%$query")->paginate(5);

        return view('traceOper', ['traces' => $traces, 'dossiers' => $dossiers]);
    }


    public function search(Request $request)
    {
        $query = $request->input('query');

        $traces = Log::join('users', 'logs.id_user', '=', 'users.id')
            ->join('dossiers', 'logs.id_dossier', '=', 'dossiers.id')
            ->leftJoin('permissions', 'logs.tache', '=', 'permissions.id')
            ->select(
                'logs.*',
                'users.name as user_name',
                'users.email',
                'dossiers.n_dossier',
                'permissions.name as permission_name'
            )
            ->where('dossiers.n_dossier', 'LIKE', "%$query%")
            ->get();

        $dossiers = Dossier::where('n_dossier', 'LIKE', "%$query%")->paginate(5);

        return view('traceOper', ['traces' => $traces, 'dossiers' => $dossiers]);
    }
}