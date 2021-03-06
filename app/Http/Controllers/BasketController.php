<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BasketInterfaceRepository;
use App\Models\Article;
use App\Models\User;
use App\Models\Adresse;

class BasketController extends Controller
{

	protected $basketRepository; // L'instance BasketSessionRepository

	public function __construct(BasketInterfaceRepository $basketRepository)
	{
		$this->basketRepository = $basketRepository;
	}

	# Affichage du panier
	public function show()
	{
		return view("basket.show"); // resources\views\basket\show.blade.php
	}

	# Ajout d'un produit au panier
	public function add($articleId, Request $request)
	{
		// Validation de la requête
		$this->validate($request, [
			"quantite" => "numeric|min:1"
		]);

		$article = Article::findOrFail($articleId);
		$quantite = $request->quantite;

		if ($article->stock >= $quantite) {

			// Ajout/Mise à jour du produit au panier avec sa quantité
			$this->basketRepository->add($article, $quantite);

		} else {
			return redirect()->back()->withErrors("Quantité en stock insuffisante !");
		}

		// Redirection vers le panier avec un message
		return redirect()->route("basket.show")->withMessage("Produit ajouté au panier");
	}

	// Suppression d'un produit du panier
	public function remove($key)
	{
		// Suppression du produit du panier par son identifiant
		$this->basketRepository->remove($key);

		// Redirection vers le panier
		return back()->withMessage("Produit retiré du panier");
	}

	// Vider le panier
	public function empty()
	{
		// Suppression des informations du panier en session
		$this->basketRepository->empty();

		// Redirection 
		return back()->withMessage("Panier vidé");
	}

	// Vider le panier après validation commande
	public function emptyAfterOrder()
	{
		// Suppression des informations du panier en session
		$this->basketRepository->empty();

		// Redirection
		return redirect('home')->withMessage("Votre commande a été validée. Merci de votre confiance.");
	}

	// valider le panier
	public function validation(Request $request)
	{
		$user = User::find(auth()->user()->id);

		$adresseLivraisonId = null;
		$adresseFacturationId = null;

		if (($request->input('adresseLivraisonId')!= null))
		{
			$adresseLivraisonId = $request->input('adresseLivraisonId');
			$adresseLivraison = Adresse::findOrFail($adresseLivraisonId);
			session(['adresseLivraison' => $adresseLivraison]);
		}

		if (($request->input('adresseFacturationId')!= null))
		{
			$adresseFacturationId = $request->input('adresseFacturationId');
			$adresseFacturation = Adresse::findOrFail($adresseFacturationId);
			session(['adresseFacturation' => $adresseFacturation]);
		}

		return view('basket/validation', [
			'user' => $user,
			'adresseLivraisonId' => $adresseLivraisonId,
			'adresseFacturationId' => $adresseFacturationId,
			]);
	}

	// valider le mode de livraison choisi et modifier le prix en conséquence
	public function chooseDelivery(Request $request)
	{
		$user = User::find(auth()->user()->id);
		$total = $request->input('total');
		$delivery = $request->input('delivery');

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

		return view('basket/validation', ['user' => $user, 'lastTotal' => $total, 'delivery' => $delivery]);
	}
}
