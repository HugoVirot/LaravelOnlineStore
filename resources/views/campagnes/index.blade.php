@extends('layouts.app')

@section('title')
    Promotions - Laravel Online Store
@endsection


@section('content')

    <h2 class='pb-5 text-center'>Promotions</h3>

        <div class="container">
            <div class="row">

                @foreach ($campagnes as $campagne)

                    <div class="container p-5 border border-info">
                        <div class="row p-2 justify-content-center text-info">
                            <h1 class="currentPromoTitle">{{ $campagne->nom }}</h1>
                        </div>
                        <div class="row p-2 justify-content-center">
                            <h4>du {{ date('d/m', strtotime($campagne->date_debut)) }} au
                                {{ date('d/m/y', strtotime($campagne->date_fin)) }}</h4>
                        </div>
                        <div class="row p-3 justify-content-center text-primary">
                            <h2>-{{ $campagne->reduction }} % sur tous ces produits</h2>
                        </div>
                        <div class="container">
                            <div class="row">

                                @foreach ($campagne->articles as $article)
                                    <div class="card text-center col-md-4 col-lg-3 p-3 m-3\" style="width: 18rem;">
                                        <img class="card-img-top" src="{{ asset("images/$article->image") }}"
                                            alt="article">
                                        <div class="card-body">
                                            <h5 class="card-title font-weight-bold">{{ $article->nom }}</h5>
                                            <p class="card-text font-italic">{{ $article->description }}</p>
                                            <p class="card-text text-danger font-weight-bold">-{{ $campagne->reduction }}%
                                            </p>
                                            <h5 class="card-text font-weight-light"><del>{{ $article->prix }} €</del>
                                                <span class="text-danger font-weight-bold">
                                                    @php
                                                        $newPrice = $article->prix - $article->prix * ($campagne->reduction / 100);
                                                        echo number_format($newPrice, 2);
                                                    @endphp
                                                    €</span>
                                            </h5>

                                            <a href="{{ route('articles.show', $article) }}">
                                                <button class="btn btn-info m-2">Détails produit</button>
                                            </a>

                                            @if (auth()->user() !== null)

                                                @if (Auth::user()->isInFavorites($article))
                                                    <!-- si dans les favoris-->
                                                    <form method="post"
                                                        action="{{ route('favoris.destroy') }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger m-2">Retirer des
                                                            favoris</button>
                                                        <input type="hidden" value="{{ $article->id }}" name="articleId">
                                                    </form>

                                                @else
                                                    <!-- si pas dans les favoris-->
                                                    <form method="post" action="{{ route('favoris.store', $article) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success m-2">Ajouter aux
                                                            favoris</button>
                                                        <input type="hidden" value="{{ $article->id }}" name="articleId">
                                                    </form>

                                                @endif

                                            @endif

                                            @if ($article->stock > 0)
                                                <form method="POST" action="{{ route('cart.add', $article->id) }}"
                                                    class="form-inline d-inline-block">
                                                    @csrf
                                                    <input type="number" min="1" max="9" name="quantite"
                                                        class="form-control mr-2"
                                                        value="{{ isset(session('cart')[$article->id]) ? session('cart')[$article->id]['quantite'] : null }}">
                                                    <button type="submit" class="btn btn-warning mt-1">+ Ajouter au
                                                        panier</button>
                                                </form>
                                            @else
                                                <button class="btn btn-danger btn-sm m-3">Article en rupture de
                                                    stock</button>
                                            @endif

                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                @endforeach

            @endsection
