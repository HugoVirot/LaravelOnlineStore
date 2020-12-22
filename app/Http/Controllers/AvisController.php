<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use App\Models\Article;

class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // 1) sauvegarde nouvelle note

        $request->validate([
            'note' => 'required',
            'commentaire' => 'min:10|max:255'
        ]);

        $articleId = $request->input('articleId');
        $newNote = intval($request->input('note'));

        // dd($newNote);

        // 2) calcul moyenne = note actuelle + nouvelle note / nb notes

        $article = Article::find($articleId); //ok
        // dd($article);

        $currentAverageNote = $article->note; // ok
        // dd($currentAverageNote);

        $allArticleReviews= Avis::where('article_id', $articleId)->get(); // ok
        // dd($allArticleReviews);

        $notesNumber = count($allArticleReviews); // ok
        // dd($notesNumber);

        $newAverageNote = ($currentAverageNote * $notesNumber + $newNote) / ($notesNumber + 1);

        // current average = 0 + new = 4   /  1

        // dd($currentAverageNote + $newNote);

        $article->note = $newAverageNote;
        // dd($article->note);

        $article->save();

        Avis::create([
            'note' => $newNote,
            'commentaire' => $request->input('commentaire'),
            'user_id' => auth()->user()->id,
            'article_id' => $articleId
        ]);

        return redirect()->back()->with('message', 'Avis enregistré !');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
