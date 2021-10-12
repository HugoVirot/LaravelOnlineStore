<?php

namespace App\Repositories;

use App\Models\Article;

interface CartInterfaceRepository {

	// Afficher le panier
	public function show();

	// Ajouter un produit au panier
	public function add(Article $article, $quantite);

	// Retirer un produit du panier
	public function remove(Article $article);

	// Vider le panier
	public function empty();

}

?>