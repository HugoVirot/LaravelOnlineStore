<?php

namespace App\Http\Controllers;

use App\Models\Gamme;
use App\Models\Article;
use App\Models\Campagne;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{

    public function __construct()       // méthode 1 restriction accès : via middleware 
    {
       return $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  if (Gate::denies('access_backoffice')) { // méthode 2 restriction accès : via Gate 
        //      abort(403);                          // autre syntaxe : if(!Gate::allows('access_backoffice'))
        //  }

        // je récupère toutes les données nécessaires
        $gammes = Gamme::all();
        $articles = Article::all();
        $campagnes = Campagne::all();
        $users = User::with('role')->get();
        
        // je renvoie la vue admin/index.blade.php en y injectant toutes ces données
        return view('admin/index', [
            'gammes' => $gammes,
            'articles' => $articles,
            'campagnes' => $campagnes,
            'users' => $users
        ]);
    }
}
