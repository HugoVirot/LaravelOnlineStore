<?php

namespace App\Http\Controllers;

use App\Models\Campagne;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

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
            ->with('campagnes')
            ->get();

        if (auth()->user()) {
            $userId = auth()->user()->id;
            $favorisIds = DB::table('favoris')->where('user_id', '=', $userId)->pluck('article_id');
            $favorisIds = $favorisIds->toArray();
        } else {
            $favorisIds = null;
        }

        return view('home', [
            'christmasArticles' => $christmasArticles,
            'topRatedArticles' => $topRatedArticles,
            'favorisIds' => $favorisIds
        ]);
    }

    public function apropos()
    {
        return view('apropos');
    }
}
