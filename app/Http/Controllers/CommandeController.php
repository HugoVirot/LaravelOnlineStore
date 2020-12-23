<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

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
        $commande = new Commande;
        $commande->numero = rand(1111111, 9999999);
        $commande->prix = $request->input('lastTotal');
        $commande->user_id = auth()->user()->id; 
        $commande->save();

        $panier = session()->get("basket"); 

        foreach ($panier as $article)
        {
            $commande->articles()->attach($article['id'], ['quantite' => $article['quantite']]);
        }

        return redirect()->route('home')->with('message', 'Votre commande a été validée. Merci de votre confiance');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Commande $commande)
    {
        $commande->load('articles');
        return view('commandes/show', ['commande' => $commande]);
    }
}
