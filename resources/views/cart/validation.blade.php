@extends("layouts.app")
@section('content')
    <div class="container text-center">
        @if (session()->has('cart'))
            <h1 class="pb-5">Valider ma commande </h1>
            <div class="table-responsive shadow mb-3">
                <table class="table table-bordered table-hover bg-white mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Produit</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Initialisation du total général à 0 -->
                        @php $total = 0 @endphp

                        <!-- On parcourt les produits du panier en session : session('cart') -->
                        @foreach (session('cart') as $key => $item)
                            <!-- On incrémente le total général par le total de chaque produit du panier -->
                            @if (count($item) > 0)
                                @php $total += $item['prix'] * $item['quantite'] @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <strong><a href="{{ route('articles.show', $key) }}"
                                                title="Afficher le produit">{{ $item['nom'] }}</a></strong>
                                    </td>
                                    @php $campagne = GetCampaign($item['id']) @endphp

                                    @if ($campagne)

                                        <td>
                                            <p class="card-text text-danger font-weight-bold">{{ $campagne->nom }} :
                                                -{{ $campagne->reduction }}%</p>
                                            <del>{{ $item['prix'] }} €</del>
                                            <span class="text-danger font-weight-bold">
                                                @php
                                                    $newPrice = $item['prix'] - $item['prix'] * ($campagne->reduction / 100);
                                                    echo number_format($newPrice, 2);
                                                @endphp
                                                €</span>

                                        </td>
                                    @else
                                        <td>{{ $item['prix'] }} €</td>
                                    @endif

                                    <td>{{ $item['quantite'] }}</td>
                                    <td>
                                        <!-- Le total du produit = prix * quantité -->
                                        {{ $item['prix'] * $item['quantite'] }} €
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr colspan="2">
                            <td colspan="4">Total général</td>
                            <td colspan="2">
                                <!-- On affiche total général -->
                                <strong>{{ $total }} €</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="container w-50 text-center p-4">
                <a class="btn btn-danger" href="{{ route('cart.empty') }}"
                    title="Retirer tous les produits du panier">Vider le panier</a>
                <a class="btn btn-primary" href="{{ route('cart.validation') }}" title="validation">Valider la
                    commande</a>

            @else
                <div class="alert alert-info">Aucun produit dans le panier</div>
        @endif
    </div>


    <h4 class="text-center p-3">Mes informations</h4>

    <div class="row pb-3">
        <div class="col-6 offset-3 text-center">
            <form class="col-12 mx-auto p-5 border border-info" action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input required type="text" class="form-control" name="prenom" value="{{ $user->prenom }}"
                        id="prenom">
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input required type="text" class="form-control" name="nom" value="{{ $user->nom }}" id="nom">
                </div>
                <div class="form-group">
                    <label for="pseudo">Pseudo</label>
                    <input required type="text" class="form-control" name="pseudo" value="{{ $user->pseudo }}"
                        id="pseudo">
                </div>
                <input type="hidden" name="email" value="{{ $user->email }}" id="email">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input required type="email" class="form-control" name="email" value="{{ $user->email }}"
                        id="email">
                </div>
                <button type="submit" class="btn btn-info text-light mt-4">Modifier</button>
            </form>
        </div>
    </div>


    <h3 class="p-3">Adresse de livraison</h3>

    <div class="row pb-3">
        <div class="col-6 offset-3 text-center border border-info">

            @if (session('adresseLivraison') !== null)
                @php $adresseLivraison = session('adresseLivraison') @endphp

                <div class="font-weight-bold pt-3">
                    <p>{{ $user->prenom }} {{ $user->nom }}</p>
                    <p>{{ $adresseLivraison->adresse }}</p>
                    <p>{{ $adresseLivraison->code_postal }} {{ $adresseLivraison->ville }}</p>
                </div>

            @else
                <p class="mt-4">Aucune adresse choisie.</p>
            @endif

            <form action="{{ route('cart.validation') }}" class="p-3" method="post">
                @csrf
                <div class="form-group">
                    <label for="adresseLivraisonId">Choisisez une adresse</label>
                    <select name="adresseLivraisonId" id="adresseLivraisonId">
                        <option value=""></option>
                        @foreach ($user->adresses as $adresse)
                            <option value="{{ $adresse->id }}">
                                <p>{{ $adresse->adresse }}</p>
                                <p>{{ $adresse->code_postal }}</p>
                                <p>{{ $adresse->ville }}</p>
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-warning">Sélectionner</button>
                </div>
            </form>

        </div>
    </div>

    <h3 class="p-3">Adresse de facturation</h3>

    <div class="row pb-3">
        <div class="col-6 offset-3 text-center border border-info">

            @if (session('adresseFacturation') !== null)
                @php $adresseFacturation = session('adresseFacturation') @endphp

                <div class="font-weight-bold pt-3">
                    <p>{{ $user->nom }} {{ $user->prenom }}</p>
                    <p>{{ $adresseFacturation->adresse }}</p>
                    <p>{{ $adresseFacturation->code_postal }} {{ $adresseFacturation->ville }}</p>
                </div>

            @else
                <p class="mt-4">Aucune adresse choisie.</p>
            @endif

            <form action="{{ route('cart.validation') }}" class="p-3" method="post">
                @csrf
                <div class="form-group">
                    <label for="adresseFacturationId">Choisisez une adresse</label>
                    <select name="adresseFacturationId" id="adresseFacturationId">
                        <option value=""></option>
                        @foreach ($user->adresses as $adresse)
                            <option value="{{ $adresse->id }}">
                                <p>{{ $adresse->adresse }}</p>
                                <p>{{ $adresse->code_postal }}</p>
                                <p>{{ $adresse->ville }}</p>
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-warning">Sélectionner</button>
                </div>
            </form>

        </div>
    </div>


    <h3 class="p-3">Type de livraison</h3>
    <form method="post" action="{{ route('cart.choosedelivery') }}">
        @csrf
        <div class="form-group">
            <input type="radio" name="delivery" id="classique" value="classique" @if (isset($delivery) && $delivery === 'classique') checked @endif>
            <label for="classique">Classique (à domicile, 48h) : 5 €</label>
        </div>
        <div class="form-group">
            <input type="radio" name="delivery" id="express" value="express" @if (isset($delivery) && $delivery === 'express') checked @endif>
            <label for="express">Express (à domicile, 24h) : 9,90 €</label>
        </div>
        <div class="form-group">
            <input type="radio" name="delivery" id="pointrelais" value="pointrelais" @if (isset($delivery) && $delivery === 'pointrelais') checked @endif>
            <label for="classique">En point-relais (48h) : 4 €</label>
        </div>
        <button type="submit" class="btn btn-info">Valider</button>
        <input type="hidden" value="{{ $total }}" name="total">
    </form>

    @if (isset($lastTotal))
        <h3 class="pt-5 pb-3 font-weight-bold">Total à payer : {{ $lastTotal }} €</h3>
        <form method="post" action="{{ route('commandes.store') }}">
            @csrf
            <input type="hidden" value="{{ $lastTotal }}" name="lastTotal">
            <button type="submit" class="btn btn-success btn-lg">Valider la commande</button>
        </form>
    @else
        <p class="pt-4">Choissez un mode de livraison pour connaître le total.
    @endif
    </div>
@endsection
