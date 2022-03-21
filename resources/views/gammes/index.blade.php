@extends('layouts.app')

@section('title')
    Gammes - Laravel Online Store
@endsection


@section('content')

    <div class="container-fluid text-center mb-4">
        <img class="w-75 border border-primary" src="{{ asset('images/ranges.jpg') }}" alt="gammes">
    </div>

    <h1 class='pb-5 text-center'>Nos gammes</h1>

    <div class="container ranges">
        <div class="row">

            @foreach ($gammes as $gamme)

                <div class="container p-5 border border-info">
                    <div class="row p-5 justify-content-center">
                        <h2 class="text-primary">{{ $gamme->nom }}</h2>
                    </div>
                    <div class="container">
                        <div class="row">
                            @foreach ($gamme->articles as $article)
                                <div class="card text-center col-md-4 col-lg-3 p-3 m-3\" style="width: 18rem;">
                                    <img class="card-img-top" src="{{ asset("images/$article->image") }}" alt="article">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">{{ $article->nom }}</h5>
                                        <p class="card-text font-italic">{{ $article->description }}</p>

                                            @php $campagne = GetCampaign($article->id) @endphp

                                            @if ($campagne !== null)

                                                <p class="card-text text-danger font-weight-bold">{{ $campagne->nom }} :
                                                    -{{ $campagne->reduction }}%</p>
                                                <h5 class="card-text font-weight-light"><del>{{ $article->prix }} €</del>
                                                    <span class="text-danger font-weight-bold">
                                                        @php
                                                            $newPrice = $article->prix - $article->prix * ($campagne->reduction / 100);
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

                                        @php $articleId = $article->id @endphp

                                        @if (auth()->user() !== null)

                                            @if (Auth::user()->isInFavorites($article))
                                                <!-- si produit dans les favoris-->
                                                <form method="post" action="{{ route('favoris.destroy') }}">
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
                                                    value="{{ isset(session('cart')[$article->id]) ? session('cart')[$article->id]['quantite'] : 1 }}">
                                                <button type="submit" class="btn btn-warning">+ Ajouter au panier</button>
                                            </form>
                                        @endif

                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach

        @endsection
