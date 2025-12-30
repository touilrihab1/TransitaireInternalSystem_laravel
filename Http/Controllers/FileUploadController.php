<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use App\Models\File;
use App\Models\Log;
use App\Models\TypeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Constraint\IsNull;
use Illuminate\Http\UploadedFile;
class FileUploadController extends Controller
{
    public function getFileUploadForm(Request $request)
    { 
        //dd($request->idaze);
        //$id = decrypt($request->idaze) ;
       // $num = $request->num ;
        if(isset($request->idaze))
        {
          $ida = $request->idaze; 
        }
        else
        {
          $ida =  $request->id;
        }
        $id = decrypt($ida);
        $dossier = Dossier::find($id);
        
        $id_crypte = Crypt::encrypt($id);
        $types = TypeFile::pluck('type', 'id');
        $files = File::where('id_dossier', $id)->get();
        return view('file-upload', compact('types', 'files'), ['idaze' => $id_crypte , 'num'=>$dossier->n_dossier]);
    }





    public function create()
{
    $type = File::all();
    return view('file-upload', compact('type'));
}


    public function store(Request $request)
    {
    
      
      $id_dossier = decrypt($request->input('id'))  ;
        $id_crypte = Crypt::encrypt( $id_dossier);

      if(auth()->user()->hasPermissionTo('annexer document')){
       // $id_dossier = $request->input('id');
        
        $request->validate([
        'file' => 'required|mimes:pdf,docx,doc,txt,png,jpg,jpeg|max:51200',
        // 'id_dossier' => 'required|exists:dossiers,id'
    ]);
   

    $fileName = $request->file->getClientOriginalName();
    $ext = pathinfo($fileName , PATHINFO_EXTENSION);
   
    $filePath = 'uploads/' . $fileName;
   
    $path = Storage::disk('public')->put($filePath, file_get_contents($request->file));
    
     $path = 'uploads/';
     $file = new File();
     $file->file_name = $fileName;
     $file->file_path= $path;
     $file->id_dossier =$id_dossier ;
     $file->type = $request->input('type');
    if($ext != 'csv'){
    $file->save();

     }
   
//-----------------etat dossier-------------------
          $dossiers = Dossier::leftJoin('dossier_tracking', function ($join) {
            $join->on('dossiers.id', '=', 'dossier_tracking.id_dossier')
          ->whereRaw('dossier_tracking.created_at = (SELECT MAX(created_at) FROM dossier_tracking WHERE id_dossier = dossiers.id)');
          })
          ->leftJoin('statut_dossier', 'dossier_tracking.id_statut', '=', 'statut_dossier.Id_Sous_Statut')
          ->select('dossiers.*',  'statut_dossier.Libelle_Sous_Statut')
          ->where('dossiers.id',$id_dossier)
          ->orderBy('dossier_tracking.created_at', 'desc')
          ->first();

          $doc = DB::table('files')
          ->where('id_dossier',$id_dossier)
          ->where('type',27)
          ->first() ;
          //----------Document pour finaliser partie Exploitation----------------------
          $doc1 = DB::table('files')
          ->where('id_dossier',$id_dossier)
          ->where('type',1)
          ->first() ;
          $doc2 = DB::table('files')
          ->where('id_dossier',$id_dossier)
          ->where('type',2)
          ->first() ;
          $doc3 = DB::table('files')
          ->where('id_dossier',$id_dossier)
          ->where('type',3)
          ->first() ;
          $doc4 = DB::table('files')
          ->where('id_dossier',$id_dossier)
          ->where('type',4)
          ->first() ;
          //-----------------Document pour cloturer Dossier----------------------
          // $doc5 =DB::table('files')
          // ->where('id_dossier',$id_dossier)
          // ->where('type',38);
          // $doc6 = DB::table('files')
          // ->where('id_dossier',$id_dossier)
          // ->where('type',27)
          // ->first();
          //----------------------------Document payement--------------------------
          $doc7 =  DB::table('files')
          ->where('id_dossier',$id_dossier)
          ->where('type',39)
          ->first();
          $doc8 =  DB::table('files')
          ->where('id_dossier',$id_dossier)
          ->where('type',19)
          ->first();

          // if($dossiers->Libelle_Sous_Statut == 'Affecter Dédouanement' && $doc != null )
          // {
          //   DB::insert('insert into dossier_tracking (id_dossier, id_statut ,created_at) values (?, ?, ?)', [$id_dossier, 19,Carbon::now() ]);
          // }
          // else
          // {
          //   DB::insert('insert into dossier_tracking (id_dossier, id_statut ,created_at) values (?, ?, ?)', [$id_dossier, 54,Carbon::now() ]);
          // }
          if ($dossiers->Libelle_Sous_Statut == 'En Cours de Traitement' && ($doc1 != null || $doc2 != null || $doc3 != null || $doc4 != null)) {
          // dd('traitement');
        
          DB::insert('insert into dossier_tracking (id_dossier, id_statut, created_at) values (?, ?, ?)', [$id_dossier, 1, Carbon::now()]);
        //   $log = Log::create([
        //     'id_dossier' => $id_dossier,
        //     'id_user' => auth()->user()->id,
        //     'tache' => 'modifier dossier'
        // ]);
        // $log->save();
          return redirect()->route('get.fileupload' , ['id' =>$id_crypte])
            
          ->with('success','File has been successfully uploaded.');
        }
        
        // if ($doc5 != null && $doc6 != null && $doc7 == null && $doc8 == null ) {
        //  // dd('cloturer');
        //  $dossierCloture = DB::table('dossier_tracking')
        //   ->where('id_dossier', $id_dossier)
        //   ->where('id_statut', 55)
        //   ->exists();
          
        //   if (!$dossierCloture) {
        //     DB::insert('insert into dossier_tracking (id_dossier, id_statut, created_at) values (?, ?, ?)', [$id_dossier, 55, Carbon::now()]);
        
        //     DB::table('affectation')
        //         ->where('id_dossier', $id_dossier)
        //         ->update(['id_role' => 5]);
        //         $log = Log::create([
        //           'id_dossier' => $id_dossier,
        //           'id_user' => auth()->user()->id,
        //           'tache' => 'clotuter dossier'
        //       ]);
        //       $log->save();
        //     }
        //         return redirect()->route('get.fileupload' , ['id' =>$id_crypte])      
        // ->with('success','File has been successfully uploaded.');
        // }
      
        if ($doc7 != null || $doc8 != null) {
          $dossierComplet = DB::table('dossier_tracking')
          ->where('id_dossier', $id_dossier)
          ->where('id_statut', 19)
          ->exists();
          
    if (!$dossierComplet) {
           DB::insert('insert into dossier_tracking (id_dossier, id_statut, created_at) values (?, ?, ?)', [$id_dossier, 19, Carbon::now()]);
        
            DB::table('facturefinal_dossier')
                ->where('id_dossier', $id_dossier)
                ->update(['etat' => 'payé']);

                $log = Log::create([
                  'id_dossier' => $id_dossier,
                  'id_user' => auth()->user()->id,
                  'tache' => 'completer dossier'
              ]);
              $log->save();
            }
                return redirect()->route('get.fileupload' , ['id' =>$id_crypte])
            ->with('success','File has been successfully uploaded.');
        }
//-----------------fin etat dossier---------------

    return redirect()->route('get.fileupload' , ['id' =>$id_crypte])

        ->with('success','File has been successfully uploaded.');

}else{
  return redirect()->route('get.fileupload' , ['id' =>$id_crypte]);


}
    }
    }

