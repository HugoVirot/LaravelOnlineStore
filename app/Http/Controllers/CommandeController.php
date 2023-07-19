<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Article;

class CommandeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // je crée la commande (pour le moment sans ses infos)
        $commande = new Commande;

        // je lui attribue ses informations 
        $commande->numero = rand(1000000, 9999999);
        $commande->prix = $request->input('lastTotal');
        $commande->user_id = auth()->user()->id;
        $commande->adresse_livraison_id = session('adresseLivraison')->id;
        $commande->adresse_facturation_id = session('adresseFacturation')->id;

        // je la sauvegarde en bdd
        $commande->save();

        // je récupère le panier (stocké dans une variable), et je boucle dessus
        $panier = session()->get("cart");

        foreach ($panier as $article) {

            // j'insère chacun de ses articles dans commande_articles (syntaxe attach)
            $commande->articles()->attach($article['id'], ['quantite' => $article['quantite'], 'reduction' => isset($article['reduction']) ? $article['reduction'] : 0]);

            // je fais baisser le stock de chaque article (stock actuel - stock commandé)
            $articleInDatabase = Article::find($article['id']);
            $articleInDatabase->stock -= $article['quantite'];
            $articleInDatabase->save();
        }

        // je redirige vers une route qui vide le panier puis qui charge l'accueil
        return redirect()->route('cart.emptyAfterOrder');
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        // je charge les articles de la commande
        $commande->load('articles');

        // je renvoie la vue commande/show pour afficher son détail
        return view('commandes/show', ['commande' => $commande]);
    }
}
