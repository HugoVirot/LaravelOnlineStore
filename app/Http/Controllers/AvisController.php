<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use Illuminate\Http\Request;
use App\Models\Article;

class AvisController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1) validation inputs requête + déclaration variables utiles pour la suite

        $request->validate([
            'note' => 'required|min:1|max:5',
            'commentaire' => 'nullable|min:10|max:255'
        ]);

        $articleId = $request->input('articleId');
        $newNote = intval($request->input('note')); // intval transforme la note en integer


        // 2) calcul moyenne = (note actuelle * nb notes + nouvelle note) / (nb notes + 1)

        $article = Article::find($articleId);
        $currentAverageNote = $article->note;                               // note moyenne actuelle de l'article
        $allArticleReviews = Avis::where('article_id', $articleId)->get();  // tous les avis postés sur cet article
        $notesNumber = count($allArticleReviews) + 1;                       // comptage du nombre de notes

        $newAverageNote = ($currentAverageNote * $notesNumber + $newNote) / ($notesNumber + 1);


        // 3) sauvegarde de la nouvelle note moyenne de l'article

        $article->note = $newAverageNote;
        $article->save();


        // 4) sauvegarde de l'avis + redirection

        Avis::create([
            'note' => $newNote,
            'commentaire' => $request->input('commentaire'),
            'user_id' => auth()->user()->id,
            'article_id' => $articleId
        ]);

        return redirect()->back()->with('message', 'Avis enregistré !');
    }
}
