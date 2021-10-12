<?php

namespace App\Repositories;

use App\Models\Article;


class cartSessionRepository implements cartInterfaceRepository  {

	# Afficher le panier
	public function show () {
		return view("cart.show"); // resources\views\cart\show.blade.php
	}


	# Ajouter/Mettre à jour un produit du panier
	public function add (Article $article, $quantite) {		
		$cart = session()->get("cart"); // On récupère le panier en session

		// Les informations du produit à ajouter
		$article_details = [
			'id' => $article->id,
			'nom' => $article->nom,
			'prix' => $article->prix,
			'description' => $article->description,
			'quantite' => $quantite
		];
		
		$cart[$article->id] = $article_details; // On ajoute ou on met à jour le produit au panier
		session()->put("cart", $cart); // On enregistre le panier
	}


	# Retirer un produit du panier
	public function remove ($key) {
		$cart = session()->get("cart"); // On récupère le panier en session
		unset($cart[$key]); // On supprime le produit du tableau $cart
		session()->put("cart", $cart); // On enregistre le panier
	}

	
	# Vider le panier
	public function empty () {
		session()->forget("cart"); // On supprime le panier en session
	}

}

?>