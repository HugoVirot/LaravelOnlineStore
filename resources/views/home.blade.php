@extends('layouts.app')

@section('content')
<div class="container-fluid text-center p-3">
    <img src="{{ asset("images/banner.jpg") }}" alt="logo" style="width : 80vw">
</div>

<div class="container text-center pt-5">
    <h1>Promotions de Noël</h1>
    <div class="row mt-5 mb-5">

        @php $articles = $christmasArticles->articles @endphp

        @for($i = 0; $i < 3; $i++) @php $image=$articles[$i]->image @endphp

            <div class="card text-center col-md-4 p-3 m-3\" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset("images/$image") }}" alt="article">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{$articles[$i]->nom}}</h5>
                    <p class="card-text font-italic">{{$articles[$i]->description}}</p>
                    <p class="card-text font-weight-light">{{$articles[$i]->prix}}€</p>

                    <a href="{{ route('articles.show', $articles[$i]) }}">
                        <button class="btn btn-info m-2">Détails produit</button>
                    </a>

                    <form method="POST" action="{{ route('basket.add', $articles[$i]->id) }}" class="form-inline d-inline-block">
                        @csrf
                        <input type="number" name="quantite" placeholder="Quantité ?" class="form-control mr-2" value="{{ isset(session('basket')[$articles[$i]->id]) ? session('basket')[$articles[$i]->id]['quantite'] : null }}">
                        <button type="submit" class="btn btn-danger">+ Ajouter au panier</button>
                    </form>
                </div>
            </div>
            @endfor

    </div>
</div>

<div class="container text-center text-light bg-primary p-5">
    <div class="row justify-content-center">
        <i class="fas fa-star fa-3x mr-4"></i>
        <h1>Produits les mieux notés</h1>
    </div>

    <div class="row mt-5 mb-5">

        @foreach ($topRatedArticles as $article)
        <div class="card text-center text-dark col-md-4 p-3 m-3\" style="width: 18rem;">
            <img class="card-img-top" src="{{ asset("images/$article->image") }}" alt="article">
            <div class="card-body">
                <h5 class="card-title font-weight-bold">{{$article->nom}}</h5>
                <p class="card-text font-italic">{{$article->description}}</p>
                <p class="card-text font-weight-light">{{$article->prix}}€</p>

                <a href="{{ route('articles.show', $article) }}">
                    <button class="btn btn-info m-2">Détails produit</button>
                </a>

                <form method="POST" action="{{ route('basket.add', $article->id) }}" class="form-inline d-inline-block">
                    @csrf
                    <input type="number" name="quantite" placeholder="Quantité ?" class="form-control mr-2" value="{{ isset(session('basket')[$article->id]) ? session('basket')[$article->id]['quantite'] : null }}">
                    <button type="submit" class="btn btn-warning">+ Ajouter au panier</button>
                </form>
            </div>
        </div>
        @endforeach

    </div>
</div>

@endsection