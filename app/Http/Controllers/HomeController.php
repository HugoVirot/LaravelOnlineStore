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
        $currentPromo = Campagne::with(['articles' => function ($query) {
            $query->limit(3);
        }])
            ->whereDate('date_debut', '<=', '2021-07-01')
            ->whereDate('date_fin', '>=', '2021-07-01')
            ->get();

        $currentPromo = $currentPromo[0];

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
            'currentPromo' => $currentPromo,
            'topRatedArticles' => $topRatedArticles,
            'favorisIds' => $favorisIds
        ]);
    }

    public function apropos()
    {
        return view('apropos');
    }
}
