<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

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
        $user->load('favoris');
        return view('favoris/index', [
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Article $article)
    {
        $articleId = $request->input('articleId');
        $user = User::find(auth()->user()->id);
        $user->favoris()->attach($articleId);
        return redirect()->back()->with('message', 'Produit ajouté aux favoris !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $articleId = $request->input('articleId');
        $user = User::find(auth()->user()->id);
        $user->favoris()->detach($articleId);
        return redirect()->back()->with('message', 'Produit retiré des favoris !');
    }
}
