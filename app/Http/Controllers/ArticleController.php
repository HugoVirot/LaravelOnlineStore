<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Campagne;
use Illuminate\Support\Facades\DB;

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

        if (auth()->user()) {
            $userId = auth()->user()->id;
            $favorisIds = DB::table('favoris')->where('user_id', '=', $userId)->pluck('article_id');
            $favorisIds = $favorisIds->toArray();
        } else {
            $favorisIds = null;
        }

        return view('articles/index', [
            'articles' => $articles,
            'campagnes' => $campagnes,
            'campagnesArticlesIds' => $campagnesArticlesIds,
            'favorisIds' => $favorisIds,
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
            'nom' => 'required|min:5|max:30',
            'description' => 'required|min:10|max:100',
            'description_detaillee' => 'required|min:50|max:500',
            'image' => 'required|min:5|max:25',
            'prix' => 'required',
            'stock' => 'required',
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
        $article->load('avis.user', 'campagnes');

        if (auth()->user()) {
            $userId = auth()->user()->id;
            $favorisIds = DB::table('favoris')->where('user_id', '=', $userId)->pluck('article_id');
            $favorisIds = $favorisIds->toArray();
        } else {
            $favorisIds = null;
        }

        return view('articles/show', [
            'article' => $article,
            'favorisIds' => $favorisIds
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles/edit', ['article' => $article]);
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

        $article->update($request->all());
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
        return redirect()->route('admin.index')->with('message', 'L\'article a bien été supprimée');
    }
}
