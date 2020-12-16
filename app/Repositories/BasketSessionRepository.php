<?php

namespace App\Repositories;

use App\Models\Article;


class BasketSessionRepository implements BasketInterfaceRepository  {

	# Afficher le panier
	public function show () {
		return view("basket.show"); // resources\views\basket\show.blade.php
	}


	# Ajouter/Mettre à jour un produit du panier
	public function add (Article $article, $quantite) {		
		$basket = session()->get("basket"); // On récupère le panier en session

		// Les informations du produit à ajouter
		$article_details = [
			'id' => $article->id,
			'nom' => $article->nom,
			'prix' => $article->prix,
			'description' => $article->description,
			'quantite' => $quantite
		];
		
		$basket[$article->id] = $article_details; // On ajoute ou on met à jour le produit au panier
		session()->put("basket", $basket); // On enregistre le panier
	}


	# Retirer un produit du panier
	public function remove ($key) {
		$basket = session()->get("basket"); // On récupère le panier en session
		unset($basket[$key]); // On supprime le produit du tableau $basket
		session()->put("basket", $basket); // On enregistre le panier
	}

	
	# Vider le panier
	public function empty () {
		session()->forget("basket"); // On supprime le panier en session
	}

}

?>