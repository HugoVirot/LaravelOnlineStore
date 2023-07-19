<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->user()->id);
        $user->load('favoris.campagnes');
        return view('favoris/index', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // je stocke dans une variable l'id de l'article transmis en hidden 
        $articleId = $request->input('articleId');

        // je récupère le user connecté grâce à son id
        $user = User::find(Auth::user()->id);

        // je vais insérer dans la table favoris : le user_id et l'article_id en question
        // $user-> la relation "favoris" (fonction dans le modèle User) -> attach (syntaxe Laravel)
        // attach insère automatiquement l'id du user + l'id de l'article fourni
        $user->favoris()->attach($articleId);

        // autre syntaxe sans attach
        // DB::table('favoris')->insert([
        //     'user_id' => $user->id,
        //     'article_id' => $articleId
        // ]);

        // on redirige avec un message de succès
        return redirect()->back()->with('message', 'Produit ajouté aux favoris !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($articleId)
    {
        // je récupère le user connecté grâce à son id
        $user = User::find(Auth::user()->id);

        // je vais supprimer la ligne qui contient l'id user + l'id article
        $user->favoris()->detach($articleId);

        // on redirige avec un message de succès
        return redirect()->back()->with('message', 'Produit retiré des favoris !');
    }
}
