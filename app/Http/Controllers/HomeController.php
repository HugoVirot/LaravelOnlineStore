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
        $currentPromo = Campagne::with(['articles' => function ($query) {
            $query->limit(3);
        }])
            ->whereDate('date_debut', '<=', date('Y-m-d'))
            ->whereDate('date_fin', '>=',  date('Y-m-d'))
            ->get();

        if (isset($currentPromo[0])) {
            $currentPromo = $currentPromo[0];
        } else {
            $currentPromo = null;
        }
        // on récupère les 3 articles les mieux notés avec leurs éventuelles campagnes promo,
        // si et seulement si elles sont en cours
        $topRatedArticles = Article::orderBy('note', 'desc')
            ->limit(3)
            ->with(['campagnes' => function ($query) {
                $query->whereDate('date_debut', '<=', date('Y-m-d'))
                    ->whereDate('date_fin', '>=', date('Y-m-d'))->get();
            }])
            ->get();

        // on récupère la liste des favoris du user, si connecté, grâce au helper GetFavorites
        $favorisIds = getFavorites();

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
