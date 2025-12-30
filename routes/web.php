<?php
use App\Http\Controllers\AdminController;

use App\Http\Controllers\ArrondissementController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FactureFinalDossier;

use App\Http\Controllers\UsertClient;
use App\Http\Livewire\FileUploadComponent;
use App\Http\Livewire\FactureModifierComponent;

use App\Http\Livewire\AffecterButton;
use App\Http\Livewire\AddLineArticle;



use App\Http\Controllers\ClientController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\DumController;
use App\Http\Controllers\FactureController;

use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\originController;
use App\Http\Controllers\nomenclatureController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\unityController;
use App\Http\Controllers\deviseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChartJSController;
use App\Http\Controllers\ClientViewController;
use App\Http\Controllers\Charge_Dossier;
use App\Http\Controllers\FactureDossierController;
use App\Http\Livewire\arrondB;
use App\Http\Livewire\BureauD;


use App\Models\Dossier;
use App\Models\Dum;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



use App\Http\Middleware\AdminMiddleware;
use App\Models\Client;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::get('/add-line-article', AddLineArticle::class);


Route::get('/', function () {
    return redirect()->route("login");
});
Route::get('/formulaire1', function () {
    return view('formulaire1');
});
Route::get('/uniteMesure', function () {
    return view('uniteMesure');
});
Route::get('/origin', function () {
    return view('origin');
});

Route::get('/formulaire', function () {
    return view('formulaire');
});

Route::get('/addFacture', function () {
    return view('addFacture');
});
Route::get('/addClient', function () {
    return view('addClient');
});
Route::get('/allClient', function () {
    return view('allClient');
});
Route::get('/ajouter', function () {
    return view('ajouter');

});

Route::get('/dum', function () {
    return view('dum.index');
});

Route::get('/tableDossier', function () {
    return view('tableDossier');


});
Route::post('/ajouter/traitement', [ClientController::class, 'save']);
Route::post('/ajouter/dossier', [DossierController::class, 'save']);


Route::get('/allClient', [ClientController::class, 'show']);



Route::get('/tableDossier', [DossierController::class, 'show']);


//  Route::post('/tableBureau', 'BureauD@store')->name('bureaux.store');


//**************************affectation************************** */
Route::get('/affectation', function () {
    return view('affectation');

});
Route::get('/showFacture', function () {
    return view('showFacture');

});
Route::get('/test', function () {
    return view('test');

});


Route::get('/affecter', [AffecterButton::class, 'affecterGetId'])->name('affecterGetId');
Route::post('/affecter', [AffecterButton::class, 'affecter']);
//**********************END affectation***************************





Route::get('/allClient', [ClientController::class, 'show']);


Route::post('/dossier/modifier', [DossierController::class, 'modifier']);
Route::post('/ajouter/modification', [DossierController::class, 'saveModification']);




Route::post('/dossier/voir', [DossierController::class, 'voir']);
Route::post('/retour/dossier', [DossierController::class, 'voir']);

Route::post('/ajouter/article', [ArticleController::class, 'save']);

Route::get('/modifierDossier', function () {
    return view('modifierDossier');

});
Route::get('/showDossier', function () {
    return view('showDossier');

});


// ----------uploaaad files routes--------------------------------//
// Route::get('file-upload', [ FileUploadController::class, 'getFileUploadForm' ])->name('get.fileupload');
// Route::post('file-upload', [ FileUploadController::class, 'store' ])->name('store.file');

Route::get('/dossier/search', [DossierController::class, 'search'])->name('dossier.search');
Route::get('/dossiers/filter', [DossierController::class, 'filter'])->name('dossier.filter');

Route::get('/trace', [LogController::class, 'show'])->name('trace.show');
Route::get('/trace/search', [LogController::class, 'search'])->name('trace.search');
Route::get('/trace', [YourController::class, 'index'])->name('trace.index');

Route::get('/file-upload', [FileUploadController::class, 'getFileUploadForm'])
    ->name('get.fileupload');


// Route::post('/file-upload', [FileUploadController::class, 'store'])
//     ->name('store.file');
Route::post('/document/store', [FileUploadController::class, 'store']);

Route::get('/files', FileUploadComponent::class);
Route::group(['middleware' => ['role:client']], function () {
    Route::get('/clientHome', function () {
        return view('clientHome');

    });
    Route::get('/statistique', function () {
        return view('clientView.statistique');

    });
    Route::get('/reclamation', function () {
        return view('clientView.reclamation');

    });
   
    Route::get('/dossierClient', function () {
        return view('clientView.dossier');

    });
    Route::get('/clientHome', [ClientViewController::class, 'index']);
    Route::get('/statistique', [ClientViewController::class, 'statistic']);
    Route::get('/dossierClient', [ClientViewController::class, 'showDossier']);
});
//---------------------------------------------/
Route::get('/dossiers', [DossierController::class, 'index'])->name('dossiers.index');

Route::get('/home', [ChartJSController::class, 'index']);

//Route::post('/dossier/{num_dossier}/cancel', 'DossierController@cancel');
//Route::post('/dossier/cancel',[DossierController::class, 'cancel']);

Auth::routes();

Route::get('/traceOper', [LogController::class, 'index'])->name('sort');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });
// Route::middleware(['auth', 'isAdmin'])->group(function () {
//     Route::get('/welcome', [App\Http\Controllers\AdminController::class, 'index'])->name('welcome');
// });
// Route::group(['middleware' => ['auth']], function() {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);

// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// });




Route::group(['middleware' => ['role:Admin']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('clients', UsertClient::class);
    Route::get('/traceOper', [LogController::class, 'show']);
});

Route::group(['middleware' => ['role:dédouanement']], function () {
    Route::get('/addFacture', function () {
        return view('addFacture');
    });
    Route::get('/voirDum/{num_dum}', [DumController::class, 'voir']);

    Route::get('/tableDossier', [DossierController::class, 'show'])->name('showDossier');
    Route::post('/facture/voir', [FactureController::class, 'voir']);
    Route::post('/creer/dum', [DumController::class, 'getId']);
    Route::post('/ajouter/facture', [AddLineArticle::class, 'save']);

    Route::post('/ajouter/dum', [DumController::class, 'save']);
    Route::post('/ajouter1/dum', [DumController::class, 'save1']);
    Route::post('/update/dum', [DumController::class, 'modifier']);
    Route::post('/modifier/facture', [FactureController::class, 'findFactureModifier']);
    Route::post('/save/modification/facture', [FactureModifierComponent::class, 'saveModification']);

    Route::post('/facture', [FactureController::class, 'findFacture']);
    Route::post('/article/ventiller', [FactureController::class, 'ventiller']);
    Route::post('/dossier/ventiller', [FactureDossierController::class, 'ventiller']);
    Route::get('/tableDossierDed', [DossierController::class, 'showDedouanement']);
    Route::resource('dum', DumController::class);
    Route::get('/formulaire1', [DumController::class, 'index']);

});
Route::group(['middleware' => ['role:exploitation']], function () {
    Route::get('/tableDossier', [DossierController::class, 'show'])->name('showDossier');





    Route::get('/formulaire1/{id_crypte}', [DumController::class, 'show'])->name('formulaire1');

    Route::post('/ajouter/charge', [Charge_Dossier::class, 'getChargeForm']);
    Route::post('/save/charge', [Charge_Dossier::class, 'save']);
    Route::post('cloturer/dossier', [DossierController::class, 'cloturer']);

});


//-------------export client excel-----------------//
Route::get('export_client', [ClientController::class, 'export']);
Route::get('export_dossier', [DossierController::class, 'export']);

//--------------------Origin----------------------------------
Route::get('/origin', [originController::class, 'index'])->name('origin.index');
Route::post('/documents/origin', [originController::class, 'delete']);
Route::post('/save/origin', [originController::class, 'store']);
Route::post('/modifier/origin', [originController::class, 'modifier']);
//--------------------Bureau douanier-------------------------------------
Route::get('/tableBureau', [BureauD::class, 'index'])->name('bureau.index');
Route::post('/save/bureau', [BureauD::class, 'store']);
Route::post('delete/bureau', [BureauD::class, 'delete']);
Route::post('/modifier/bureau', [BureauD::class, 'modifier']);
//------------------Devise--------------------------------
Route::get('/devise', [deviseController::class, 'show'])->name('devise.show');
Route::post('/store/devise', [deviseController::class, 'store']);
Route::post('delete/devise', [deviseController::class, 'delete']);
Route::post('/modifier/devise', [deviseController::class, 'modifier']);
//--------------------Article---------------------------------------
Route::get('article', [articleController::class, 'index']);
Route::post('/save/article', [ArticleController::class, 'store']);
Route::post('/modifier/article', [ArticleController::class, 'modifier']);
Route::post('/documents/article', [ArticleController::class, 'delete']);
Route::get('documents/article/search', [ArticleController::class, 'search'])
    ->name('article.search');
Route::get('article', [articleController::class, 'index'])->name('articles.index');

//-----------------unity-mesure-table----------------------------------//
Route::get('/uniteMesure', [unityController::class, 'show'])->name('unite.show');
Route::post('/save/unite', [unityController::class, 'store']);
Route::post('/modifier/unite', [unityController::class, 'modifier']);



//------------------Arrondissement-----------------------------------------
Route::get('/tableArrond', [ArrondissementController::class, 'index'])->name('arrodissement.index');
Route::post('/delete/arrondissement', [ArrondissementController::class, 'delete']);
Route::post('/save/arrondissement', [ArrondissementController::class, 'store']);
Route::post('/modifier/arrondissement', [ArrondissementController::class, 'modifier']);
Route::get('/nomenclature', [nomenclatureController::class, 'show']);

// Route::delete('/uniteMesure/{id}', 'UnityController@destroy')->name('uniteMesure.destroy');
// Route::delete('/documents/uniteMesure/{Id_Unite_Mesure}', 'UnityController@destroy')->name('uniteMesure.destroy');
//Route::delete('/documents/uniteMesure', 'unityController@destroy')->name('uniteMesure.destroy');
// Route::get('/origin',[originController::class , 'show']) ;
Route::post('/documents/uniteMesure', [unityController::class, 'delete']);

Route::post('/documents/nomenclature', [nomenclatureController::class, 'delete']);

//Route::get('/documents/origin', [originController::class, 'index']);

//-----------------//
Route::get('/searchClients', [ClientController::class, 'searchClients']);
Route::get('/searchClients', [ClientController::class, 'searchClients'])->name('searchClients');

Route::post('/save/devise', [LogController::class, 'changeDevise']);


//-------------------pagination------------------//

Route::get('nomenclature', [nomenclatureController::class, 'index']);



Route::get('allClient', [ClientController::class, 'index']);

Route::get('autocomplete', [DossierController::class, 'autocomplete'])->name('autocomplete');

// routes/web.php

//---------------------------------Agent Facturation---------------------------------
Route::group(['middleware' => ['role:facturation']], function () {

    Route::get('tableFacture', [FactureFinalDossier::class, 'index']);
    Route::get('tableFactureMens', [FactureFinalDossier::class, 'indexMens']);
    Route::post('/ajouter/factureFinal', [FactureFinalDossier::class, 'Invoice']);
    Route::post('/ajouter/factureFinalMensuelle', [FactureFinalDossier::class, 'InvoiceMens']);


});

Route::get('dossiers', [DossierController::class, 'getDossiers'])->name('get.dossiers');


// Route::get('/', function () {

// $doss = Dossier::query()->create([
//     'n_dossier' => '2345678'
// ]);

// $fl = App\Models\File::create([
//     'id_dossier'=> $doss->id,
//     'file_name'=> 'file name',
//     'file_path'=> 'Path to file'
// ]);

// $fl = App\Models\File::where('id', '=', 1)->with('dossier')->get();
// $doss = App\Models\Dossier::query()
//             ->where('id', '=', 4)
//             ->with('files')->get();



//     $fl
//     dd( $doss ) ;

//     return 'test';

// });

// Route::get('/test', function () {

//     // $doss = App\Models\Log::latest()->get();
//     $doss = App\Models\Log::query()
//         ->select()
//         ->where('tache' , '=' , 0)->get();
//     dd($doss);
//         return 'test';
// });
// Route::get('/nomenclature', [nomenclatureController::class, 'index'])->name('documents.nomenclature.index');
// Route::get('/nomenclature/create', [nomenclatureController::class, 'create']);
// Route::get('/nomenclature/{id}', [nomenclatureController::class, 'show']);
// Route::get('/nomenclature/{id}/edit', [nomenclatureController::class, 'modifier'])->name('documents.nomenclature.modifier');
// Route::get('documents/nomenclature/search', [nomenclatureController::class, 'search'])->name('documents.nomenclature.search');

// Route::post('/nomenclature', [nomenclatureController::class, 'store']);
// Route::patch('/nomenclature/{id}', [nomenclatureController::class, 'update'])->name('documents.nomenclature.update');
// Route::delete('/nomenclature/{id}', [nomenclatureController::class, 'destroy']);
Route::post('/save/nomenclature', [ArticleController::class, 'store']);
Route::post('/modifier/nomenclature', [nomenclatureController::class, 'modifier']);
Route::post('/documents/nomenclature', [nomenclatureController::class, 'destroy']);
Route::get('documents/nomenclature/search', [nomenclatureController::class, 'search'])->name('documents.nomenclature.search');

Route::get('/nomenclature', [nomenclatureController::class, 'index'])->name('documents.nomenclature.index');
Route::get('/nomenclature/create', [nomenclatureController::class, 'create']);

Route::get('bureau.search', [BureauD::class, 'search'])->name('bureau.search');
Route::get('arrond.search', [ArrondissementController::class, 'search'])->name('arrond.search');