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
        $campagnes = Campagne::all();
        
        if (auth()->user()) {
            $userId = auth()->user()->id;
            $favorisIds = DB::table('favoris')->where('user_id', '=', $userId)->pluck('article_id');
            $favorisIds = $favorisIds->toArray();
        } else {
            $favorisIds = null;
        }

        return view('campagnes/index', [
            'campagnes' => $campagnes,
            'favorisIds' => $favorisIds
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|min:5|max:30',
            'reduction' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required'
        ]);

        // dd($request);

        $campagne = Campagne::create($request->all());

        $articles = Article::all();

        for ($i = 0; $i < count($articles); $i++) {
            if (isset($request['article' . $i])) {

                $campagne->articles()->attach([$request['article' . $i]]);
            }
        }

        return redirect()->route('admin.index')->with('message', 'Campagne créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Campagne $campagne)
    {
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

        // on associe à la campagne ceux cochés dans le formulaire
        for ($i = 0; $i < count($articles); $i++) {
            if (isset($request['article' . $i])) {
                $campagne->articles()->attach([$request['article' . $i]]);
            }
        }

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
        $campagne->articles()->detach();
        $campagne->delete();
        return redirect()->route('admin.index')->with('message', 'La campagne a bien été supprimée');
    }
}
