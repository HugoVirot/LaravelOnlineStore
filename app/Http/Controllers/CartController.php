<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Adresse;
use Illuminate\Support\Facades\Gate;


class CartController extends Controller
{

	# Affichage du panier
	public function show()
	{
		return view("cart.show"); // resources\views\cart\show.blade.php
	}

	# Ajout d'un produit au panier
	public function add($articleId, Request $request)
	{
		// Validation de la requête
		$this->validate($request, [
			"quantite" => "numeric|min:1"
		]);

		$article = Article::find($articleId);  // on récupère l'article
		$article->campagne = getCampaign($articleId); // on récupère son éventuelle campagne en cours (sinon => null)
		$quantite = $request->quantite; // on récupère la quantité choisie

		if ($article->stock >= $quantite) {  // si le stock restant est suffisant

			// Ajout/Mise à jour du produit au panier avec sa quantité
			$cart = session()->get("cart"); // On récupère le panier en session

			// Les informations du produit à ajouter
			$article_details = [
				'id' => $article->id,
				'nom' => $article->nom,
				'prix' => $article->prix,
				'description' => $article->description,
				'quantite' => $quantite
			];

			// si l'article est concerné par une promo ET si celle-ci est en cours => on prend en compte sa réduction
			if ($article->campagne) {
				$article_details['campagne'] = $article->campagne;
				$article_details['reduction'] = $article->campagne->reduction;
			}

			$cart[$article->id] = $article_details; // On ajoute ou on met à jour le produit au panier
			session()->put("cart", $cart); // On enregistre le panier

		} else {
			return redirect()->back()->withErrors("Quantité en stock insuffisante !");
		}

		// Redirection vers le panier avec un message
		return redirect()->route("cart.show")->withMessage("Produit ajouté au panier");
	}

	// Suppression d'un produit du panier
	public function remove($key)
	{
		// Suppression du produit du panier par son identifiant
		$cart = session()->get("cart"); // On récupère le panier en session
		unset($cart[$key]); // On supprime le produit du tableau $cart
		session()->put("cart", $cart); // On enregistre le panier

		// Redirection vers le panier
		return back()->withMessage("Produit retiré du panier");
	}

	// Vider le panier
	public function empty()
	{
		// Suppression du panier en session
		session()->forget("cart");

		// Redirection 
		return back()->withMessage("Panier vidé");
	}

	// Vider le panier après validation commande
	public function emptyAfterOrder()
	{
		// Suppression des informations du panier en session
		session()->forget("cart");

		// Redirection
		return redirect('home')->withMessage("Votre commande a été validée. Merci de votre confiance.");
	}

	// valider le panier
	public function validation(Request $request)
	{
		if (Gate::denies("access_order_validation")){
			abort(403, 'Vous n\'êtes pas connecté');
		}

		$user = User::find(auth()->user()->id);

		// si je viens de choisir une adresse de livraison 
		if (($request->adresseLivraisonId)) {
			$adresseLivraisonId = $request->adresseLivraisonId; // je stocke l'id de cette adresse choisie
			$adresseLivraison = Adresse::findOrFail($adresseLivraisonId); // je récupère en bdd l'adresse correspondante
			session(['adresseLivraison' => $adresseLivraison]); // je la stocke dans la session
			// autre syntaxe : session()->put('adresseLivraison' => $adresseLivraison);
		}

		// si je viens de choisir une adresse de facturation => même principe 
		if (($request->adresseFacturationId)) {
			$adresseFacturationId = $request->input('adresseFacturationId');
			$adresseFacturation = Adresse::findOrFail($adresseFacturationId);
			session(['adresseFacturation' => $adresseFacturation]);
		}

		return view('cart/validation', ['user' => $user]);
	}

	// valider le mode de livraison choisi et modifier le prix en conséquence
	public function chooseDelivery(Request $request)
	{
		$user = User::find(auth()->user()->id);
		$total = $request->input('total');
		$delivery = $request->input('delivery');

		session()->put('delivery', $delivery);

		switch ($delivery) {
			case ('classique'):
				$total += 5;
				break;
			case ('express'):
				$total += 9.90;
				break;
			case ('pointrelais'):
				$total += 4;
				break;
		}

		session()->put('finalTotal', $total);

		return view('cart/validation', ['user' => $user]);
	}
}
