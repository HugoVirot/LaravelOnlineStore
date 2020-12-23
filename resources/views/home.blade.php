@extends('layouts.app')

@section('content')
<div class="container-fluid text-center p-3">
    <img src="{{ asset("images/banner.jpg") }}" alt="logo" style="width : 80vw">
</div>

<div class="container text-center pt-5 mb-3">
    <div class="row justify-content-center">
        <i class="fas fa-tree fa-3x mr-4"></i>
        <h1>Promotions de Noël</h1>
    </div>
    <div class="row mt-5 mb-5">

        @php $articles = $christmasArticles->articles @endphp

        @for($i = 0; $i < 3; $i++) @php $image=$articles[$i]->image @endphp

            <div class="card text-center col-md-4 p-3 m-3\" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset("images/$image") }}" alt="article">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{$articles[$i]->nom}}</h5>
                    <p class="card-text font-italic">{{$articles[$i]->description}}</p>
                    <h5 class="card-text font-weight-light"><del>{{$articles[$i]->prix}} €</del>
                        <span class="text-danger font-weight-bold">
                            @php
                            $newPrice = $articles[$i]->prix - $articles[$i]->prix * ($christmasArticles->reduction/100);
                            echo number_format($newPrice, 2)
                            @endphp
                            €</span>
                    </h5>

                    <a href="{{ route('articles.show', $articles[$i]) }}">
                        <button class="btn btn-info m-2">Détails produit</button>
                    </a>


                    @php $articleId = $articles[$i]->id @endphp

                    @if(auth()->user()!== null)
                    @if(in_array($articleId, $favorisIds))
                    <!-- si dans les favoris-->
                    <form method="post" action="{{ route('favoris.destroy', $articles[$i]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-warning m-2">Retirer des favoris</button>
                        <input type="hidden" value="{{$articles[$i]->id}}" name="articleId">
                    </form>

                    @else
                    <!-- si pas dans les favoris-->
                    <form method="post" action="{{ route('favoris.store', $articles[$i]) }}">
                        @csrf
                        <button type="submit" class="btn btn-success m-2">Ajouter aux favoris</button>
                        <input type="hidden" value="{{$articles[$i]->id}}" name="articleId">
                    </form>

                    @endif
                    @endif

                    <form method="POST" action="{{ route('basket.add', $articles[$i]->id) }}" class="form-inline d-inline-block">
                        @csrf
                        <input type="number" name="quantite" placeholder="Quantité ?" class="form-control mr-2" value="{{ isset(session('basket')[$articles[$i]->id]) ? session('basket')[$articles[$i]->id]['quantite'] : null }}">
                        <button type="submit" class="btn btn-danger">+ Ajouter au panier</button>
                    </form>
                </div>
            </div>
            @endfor
            <div class="container text-center pt-4">
                <a href="{{ route('campagnes.index')}}">
                    <button class="btn btn-lg btn-warning">Voir toutes les promotions</button>
                </a>
            </div>

    </div>
</div>

<div class="container text-center text-light bg-primary p-5">
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
                    <h4 class="card-title font-weight-bold text-warning">Note : {{$article->note}} / 5</h4>
                </div>
                <h5 class="card-title font-weight-bold">{{$article->nom}}</h5>
                <p class="card-text font-italic">{{$article->description}}</p>

                @if(isset($article->campagnes[0]))
                @php
                $campagne = ($article->campagnes)->toArray();
                $reduction = $campagne[0]['reduction'];
                @endphp
                <p class="card-text text-danger font-weight-bold">-{{$reduction}}%</p>
                <h5 class="card-text font-weight-light"><del>{{$article->prix}} €</del>
                    <span class="text-danger font-weight-bold">
                        @php
                        $newPrice = $article->prix - $article->prix * ($reduction/100);
                        echo number_format($newPrice, 2)
                        @endphp
                        €</span>
                </h5>
                @else
                <h5 class="card-text font-weight-light">{{$article->prix}} €</h5>
                @endif

                <a href="{{ route('articles.show', $article) }}">
                    <button class="btn btn-info m-2">Détails produit</button>
                </a>


                @php $articleId = $article->id @endphp

                @if(auth()->user()!== null)
                @if(in_array($articleId, $favorisIds))
                <!-- si dans les favoris-->
                <form method="post" action="{{ route('favoris.destroy', $article) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-warning m-2">Retirer des favoris</button>
                    <input type="hidden" value="{{$article->id}}" name="articleId">
                </form>

                @else
                <!-- si pas dans les favoris-->
                <form method="post" action="{{ route('favoris.store', $article) }}">
                    @csrf
                    <button type="submit" class="btn btn-success m-2">Ajouter aux favoris</button>
                    <input type="hidden" value="{{$article->id}}" name="articleId">
                </form>

                @endif
                @endif

                <form method="POST" action="{{ route('basket.add', $article->id) }}" class="form-inline d-inline-block">
                    @csrf
                    <input type="number" name="quantite" placeholder="Quantité ?" class="form-control mr-2" value="{{ isset(session('basket')[$article->id]) ? session('basket')[$article->id]['quantite'] : null }}">
                    <button type="submit" class="btn btn-danger mt-2">+ Ajouter au panier</button>
                </form>
            </div>
        </div>
        @endforeach

        <div class="container text-center pt-4">
            <a href="{{ route('articles.index')}}">
                <button class="btn btn-lg btn-warning">Voir tout le catalogue</button>
            </a>
        </div>
    </div>
</div>

@endsection