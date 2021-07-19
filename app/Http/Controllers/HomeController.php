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
            ->whereDate('date_debut', '<=', date('Y-m-d'))
            ->whereDate('date_fin', '>=',  date('Y-m-d'))
            ->get();

        $currentPromo = $currentPromo[0];

        // on récupère les 3 articles les mieux notés avec leurs éventuelles campagnes promo,
        // si et seulement si elles sont en cours
        $topRatedArticles = Article::orderBy('note', 'desc')
            ->limit(3)
            ->with(['campagnes' => function ($query){
                $query->whereDate('date_debut', '<=', date('Y-m-d'))
                ->whereDate('date_fin', '>=', date('Y-m-d'))->get();
            }])
            ->get();

        // on récupère les favoris du user si connecté. 
        // pluck permet ici de récupérer uniquement les ids des articles en favoris
        // on l'utilise car le code qui précède génère une collection
        // on transforme ensuite le tout en array avec toArray()
        // dans la vue, on vérifiera si l'id de chaque article affiché fait partie des favoris
        // si oui => bouton "retirer des favoris" / sinon => bouton "ajouter aux favoris"
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
