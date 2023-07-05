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
        // récupérer la promo en cours
        $currentPromo = Campagne::with(['articles' => function ($query) {
            $query->limit(3);
        }])
            ->whereDate('date_debut', '<=', date('Y-m-d')) //2022-02-09  format de date mysql
            ->whereDate('date_fin', '>=',  date('Y-m-d'))
            ->get();

        if (isset($currentPromo[0])) {
            $currentPromo = $currentPromo[0];
        } else {
            $currentPromo = null;
        }

        // on récupère les 3 articles les mieux notés avec leurs éventuelles campagnes promo,
        // si et seulement si elles sont en cours
        $topRatedArticles = Article::orderBy('note', 'desc')  // desc = descaling = décroissant
            ->limit(3)
            ->with(['campagnes' => function ($query) {
                $query->whereDate('date_debut', '<=', date('Y-m-d'))
                    ->whereDate('date_fin', '>=', date('Y-m-d'))->get();
            }])
            ->get();

        return view('home', [
            'currentPromo' => $currentPromo,
            'topRatedArticles' => $topRatedArticles,
        ]);
    }

    public function apropos()
    {
        return view('apropos');
    }

    public function politique()
    {
        return view('politique');
    }
}
