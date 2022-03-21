@extends('layouts.app')

@section('title')
    Laravel Online Store
@endsection

@section('content')
    <div class="container-fluid text-center">
        <img id="summerImage" src="{{ asset('images/autumn.jpg') }}" alt="logo">
    </div>

    @if ($currentPromo)

        <div class="container text-center pt-5 mb-3">
            <div class="col justify-content-center">
                <h1 class="currentPromoTitle">{{ $currentPromo->nom }}</h1>
                <h1 class="text-primary">-{{ $currentPromo->reduction }}% sur une sélection d'articles</h1>
                <h2>du {{ date('d/m', strtotime($currentPromo->date_debut)) }} au
                    {{ date('d/m/y', strtotime($currentPromo->date_fin)) }}</h2>
            </div>
            <div class="row mt-5 mb-5">

                @foreach ($currentPromo->articles as $article)

                    <div class="card text-center col-md-4 p-3 m-3\" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset("images/$article->image") }}" alt="article">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ $article->nom }}</h5>
                            <p class="card-text font-italic">{{ $article->description }}</p>
                            <p class="card-text text-danger font-weight-bold">-{{ $currentPromo->reduction }}%</p>
                            <h5 class="card-text font-weight-light"><del>{{ $article->prix }} €</del>
                                <span class="text-danger font-weight-bold">
                                    @php
                                        $newPrice = $article->prix - $article->prix * ($currentPromo->reduction / 100);
                                        echo number_format($newPrice, 2);
                                    @endphp
                                    €</span>
                            </h5>

                            <a href="{{ route('articles.show', $article) }}">
                                <button class="btn btn-info text-light m-2">Détails produit</button>
                            </a>

                            <!-- si l'utilisateur est connecté (sinon, pas de gestion des favoris)-->
                            @if (auth()->user() !== null)

                                <!-- si le produit est déjà dans les favoris-->
                                @if (Auth::user()->isInFavorites($article))
                                    <form method="post" action="{{ route('favoris.destroy') }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-warning m-2">Retirer des favoris</button>
                                        <input type="hidden" value="{{ $article->id }}" name="articleId">
                                    </form>

                                    <!-- si le produit n'est pas dans les favoris-->
                                @else
                                    <form method="post" action="{{ route('favoris.store') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-success m-2">Ajouter aux favoris</button>
                                        <input type="hidden" value="{{ $article->id }}" name="articleId">
                                    </form>

                                @endif

                            @endif

                            @if ($article->stock > 0)
                                <form method="POST" action="{{ route('cart.add', $article->id) }}"
                                    class="form-inline d-inline-block">
                                    @csrf
                                    <input type="number" min="1" max="9" name="quantite" class="form-control mr-2"
                                        value="{{ isset(session('cart')[$article->id]) ? session('cart')[$article->id]['quantite'] : 1 }}">
                                    <button type="submit" class="btn btn-warning mt-2">+ Ajouter au panier</button>
                                </form>
                            @endif

                        </div>
                    </div>
                @endforeach
                <div class="container text-center pt-4">
                    <a href="{{ route('campagnes.index') }}">
                        <button class="btn btn-lg btn-warning">Voir toutes les promotions</button>
                    </a>
                </div>

            </div>
        </div>

    @endif

    <div class="container text-center text-light bg-primary p-5 mt-5">
        <div class="row justify-content-center">
            <i class="fas fa-star fa-3x mr-4"></i>
            <h1>Produits les mieux notés</h1>
        </div>

        <div class="row mt-5">

            @foreach ($topRatedArticles as $article)
                <div class="card text-center text-dark col-md-4 p-3 m-3\" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset("images/$article->image") }}" alt="article">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold">#{{ $loop->iteration }}</h5>
                        <div class="row justify-content-center align-middle">
                            <i class="text-warning fas fa-star mr-2 "></i>
                            <h4 class="card-title font-weight-bold text-warning">Note : {{ $article->note }} / 5</h4>
                        </div>
                        <h5 class="card-title font-weight-bold">{{ $article->nom }}</h5>
                        <p class="card-text font-italic">{{ $article->description }}</p>

                        @if (isset($article->campagnes[0]))
                            @php
                                $campagne = $article->campagnes->toArray();
                                $reduction = $campagne[0]['reduction'];
                            @endphp
                            <p class="card-text text-danger font-weight-bold">-{{ $reduction }}%</p>
                            <h5 class="card-text font-weight-light"><del>{{ $article->prix }} €</del>
                                <span class="text-danger font-weight-bold">
                                    @php
                                        $newPrice = $article->prix - $article->prix * ($reduction / 100);
                                        echo number_format($newPrice, 2);
                                    @endphp
                                    €</span>
                            </h5>
                        @else
                            <h5 class="card-text font-weight-light">{{ $article->prix }} €</h5>
                        @endif

                        <a href="{{ route('articles.show', $article) }}">
                            <button class="btn btn-info m-2">Détails produit</button>
                        </a>


                        @php $articleId = $article->id @endphp

                        @if (auth()->user() !== null)
                            @if (Auth::user()->isInFavorites($article))
                                <!-- si dans les favoris-->
                                <form method="post" action="{{ route('favoris.destroy') }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-warning m-2">Retirer des favoris</button>
                                    <input type="hidden" value="{{ $article->id }}" name="articleId">
                                </form>

                            @else
                                <!-- si pas dans les favoris-->
                                <form method="post" action="{{ route('favoris.store') }}">
                                    @csrf
                                    <input type="hidden" value="{{ $article->id }}" name="articleId">
                                    <button type="submit" class="btn btn-success m-2">Ajouter aux favoris</button>
                                </form>

                            @endif
                        @endif

                        @if ($article->stock > 0)
                            <form method="POST" action="{{ route('cart.add', $article->id) }}"
                                class="form-inline d-inline-block">
                                @csrf
                                <input type="number" min="1" max="9" name="quantite" class="form-control mr-2"
                                    value="{{ isset(session('cart')[$article->id]) ? session('cart')[$article->id]['quantite'] : 1 }}">
                                <button type="submit" class="btn btn-warning mt-2">+ Ajouter au panier</button>
                            </form>
                        @endif

                    </div>
                </div>
            @endforeach

            <div class="container text-center pt-4">
                <a href="{{ route('articles.index') }}">
                    <button class="btn btn-lg btn-warning">Voir tout le catalogue</button>
                </a>
            </div>
        </div>
    </div>

@endsection
