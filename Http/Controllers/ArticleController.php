<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\nomenclature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleController extends Controller
{

    public function index()
    {
        $article = Article::sortable()->paginate(10);

        return view('articles.index', compact('article'));
    }
    
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Perform the search query using the input value
        $articles = Article::where('Code_Article', 'like', "%$search%")
            ->orWhere('Designation_Article', 'like', "%$search%")
            ->paginate(10);

        return view('articles.index', ['article' => $articles]);
    }

  
    public function store(Request $request)
    {
        $codeArticle = $request->codeArticle;
        $designationArticle =$request->designationArticle;
        $codeNomenclature = $request->codeNomenclature ;
        $id_nomenclature = nomenclature::where('Code_Nomenclature',$codeNomenclature)
        ->select('Id_Nomenclature')
        ->first() ;
        
        $article = new Article() ;
        $article->Id_Nomenclature = $id_nomenclature->Id_Nomenclature; 
        $article->Code_Article = $codeArticle ;
        $article->Designation_Article = $designationArticle ;
        $article->Code_Nomencl = $codeNomenclature ;
        $article->save() ;
        return redirect()->route('articles.index');
    }
 
    public function modifier(Request $request)
    {
        $id_article =$request->ida ;
        $codeArticle = $request->codeArticle;
        $designationArticle =$request->designationArticle;
        $codeNomenclature = $request->codeNomenclature ;
        $id_nomenclature = nomenclature::where('Code_Nomenclature',$codeNomenclature)
        ->select('Id_Nomenclature')
        ->first() ;
        Article::where('Id_Article',$id_article)
        ->update(['Code_Article' =>$codeArticle , 'Designation_Article'=>$designationArticle , 'Code_Nomencl'=>$codeNomenclature ,'Id_Nomenclature'=>$id_nomenclature->Id_Nomenclature ]);
        return redirect()->route('articles.index');
    }
    public function delete(Request $request)
    {
        $nm = Article::find($request->input('ida1'));
        if ($nm) {
            $nm->delete();
            Session::flash('success', 'Record deleted successfully.');
        } else {
            Session::flash('error', 'Record not found.');
        }
        return redirect()->back();
    }
}
