<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampagneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // on récupère uniquement les campagnes à la fois commencées et non terminées (sinon, inutiles)
        $campagnes = Campagne::whereDate('date_fin', '>=',  date('Y-m-d'))->orderBy('date_debut')->get();

        // on renvoie la vue de l'index des campagnes en y injectant les campagnes récupérées
        return view('campagnes/index', ['campagnes' => $campagnes]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // sauvegarde de la campagne avec infos de base

        $request->validate([
            'nom' => 'required|min:5|max:30',
            'reduction' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required'
        ]);

        // en la sauvegardant, je la stocke dans une variable
        $campagne = Campagne::create($request->all());

        // insertion des articles associés dans campagne_articles

        // ********************* version 1 : on boucle sur la liste des articles *********************

        // $i = 1 => valeur de départ de $i 
        // $i < count($articles) => condition de maintien
        // $i++ => évolution de $i à chaque boucle
        // for ($i = 1; $i < Article::count(); $i++) { // boucle for qui parcourt les articles

        //     if (isset($request['article' . $i])) {  // on vérifie si un imput contenant ce name a été transmis (si l'article a été coché)

        //         $campagne->articles()->attach([$i]); // on insère l'article dans campagnes_articles 

        //     }
        // }

        // ********************* version 2 (la meilleure): on boucle sur $request *********************

        foreach ($request->request as $key => $value) {
            // si le name de l'input commence par article (exemple : "article2")
            if (str_starts_with($key, 'article')) {
                $campagne->articles()->attach([$value]); // on insère l'article correspondant dans campagnes_articles 
            }
        }

        return redirect()->route('admin.index')->with('message', 'Campagne créée avec succès');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campagne $campagne)
    {
        // récupérer liste articles associés à la campagne
        $campagneArticlesIds = DB::table('campagne_articles')->where('campagne_id', '=', $campagne->id)->get('article_id');
        $articles = Article::all();

        return view('campagnes/edit', [
            'campagne' => $campagne,
            'articles' => $articles,
            'campagneArticlesIds' => $campagneArticlesIds
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campagne $campagne)
    {
        $request->validate([
            'nom' => 'required|min:5|max:30',
            'reduction' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required'
        ]);

        // on sauvegarde les modifications issues du formulaire
        $campagne->update($request->all());

        // on charge les articles associés à la campagne
        $campagne->load('articles');

        // on les retire de la table intermédiaire
        foreach ($campagne->articles as $article) {
            $campagne->articles()->detach($article);
        }

        // on récupère la liste des articles
        $articles = Article::all();

        // on associe à la campagne les articles cochés dans le formulaire (version boucle for)
        // for ($i = 0; $i < count($articles); $i++) {
        //     if (isset($request['article' . $i])) {
        //         $campagne->articles()->attach([$request['article' . $i]]);
        //     }
        // }

        //  on associe à la campagne les articles cochés dans le formulaire (version foreach)
        foreach ($articles as $article) {

            if (isset($request['article' . $article->id])) {

                $campagne->articles()->attach([$article->id]);
            }
        }

        // on redirige sur l'accueil du back-office avec un message de succès
        return redirect()->route('admin.index')->with('message', 'Campagne modifiée avec succès');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campagne $campagne)
    {
        // je supprime toutes les lignes dans campagne_articles qui comprennent l'id de la commande
        $campagne->articles()->detach();

        // je supprime la campagne
        $campagne->delete();

        // on redirige sur l'accueil du back-office avec un message de succès
        return redirect()->route('admin.index')->with('message', 'La campagne a bien été supprimée');
    }
}
