<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Campagne;
use Illuminate\Support\Facades\DB;
use App\Models\Gamme;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $articles = Article::all();

        $campagnes = Campagne::all();
        
        $campagnesArticlesIds = DB::table('campagne_articles')->pluck('article_id');
        $campagnesArticlesIds = $campagnesArticlesIds->toArray();

        return view('articles/index', [
            'articles' => $articles,
            'campagnes' => $campagnes,
            'campagnesArticlesIds' => $campagnesArticlesIds,
        ]);
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
            'nom' => 'required|string|min:5|max:30',
            'description' => 'required|min:10|max:100',
            'description_detaillee' => 'required|min:50|max:500',
            'image' => 'required|min:5|max:25',
            'prix' => 'required',
            'stock' => 'required',
            'note' => 'required',
            'gamme_id' => 'required'
        ]);

        Article::create($request->all());
        return redirect()->route('admin.index')->with('message', 'Article créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        // récupération de l'article avec ses avis et les users qui les ont postés
        // + son éventuelle campagne promo (si et seulement si elle est en cours)
        $article->load('avis.user');
        $article->load(['campagnes' => function ($query) {
            $query->whereDate('date_debut', '<=', date('Y-m-d'))
                ->whereDate('date_fin', '>=', date('Y-m-d'));
        }]);

        return view('articles/show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles/edit', [
            'article' => $article,
            'gammes' => Gamme::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'nom' => 'required|min:5|max:30',
            'description' => 'required|min:10|max:100',
            'description_detaillee' => 'required|min:50|max:500',
            'image' => 'required|min:5|max:25',
            'prix' => 'required',
            'stock' => 'required',
            'gamme_id' => 'required'
        ]);

        $article->update($request->except('_token'));
        return redirect()->route('admin.index')->with('message', 'Article modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.index')->with('message', 'L\'article a bien été supprimé');
    }
}
