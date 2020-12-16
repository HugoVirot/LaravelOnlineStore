<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\BasketInterfaceRepository;
use App\Models\Article;
use App\Models\User;

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

		$article = Article::findOrFail($articleId);

		// Validation de la requête
		$this->validate($request, [
			"quantite" => "numeric|min:1"
		]);

		// Ajout/Mise à jour du produit au panier avec sa quantité
		$this->basketRepository->add($article, $request->quantite);
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

		// Redirection vers le panier
		return back()->withMessage("Panier vidé");
	}

	// valider le panier
	public function validation()
	{
		$user = User::find(auth()->user()->id);
		return view('basket/validation', ['user' => $user]);
	}


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


	public function validateOrder()
	{
	}
}
