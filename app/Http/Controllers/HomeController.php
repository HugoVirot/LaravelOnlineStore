<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Article;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $christmasArticles = Campagne::with('articles')
            ->where('id', '=', '2')
            ->get();
        $christmasArticles = $christmasArticles[0];

        $topRatedArticles = Article::orderBy('note', 'desc')
            ->limit(3)
            ->get();

        return view('home', [
            'christmasArticles' => $christmasArticles,
            'topRatedArticles' => $topRatedArticles
        ]);
    }


    public function apropos()
    {
        return view('apropos');
    }
}
