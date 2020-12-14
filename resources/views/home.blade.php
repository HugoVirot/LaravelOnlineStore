@extends('layouts.app')

@section('content')
<div class="container-fluid text-center p-3">
    <img src="{{ asset("images/banner.jpg") }}" alt="logo" style="width : 80vw">
</div>

<div class="container text-center p-5">
    <h1>Promotions de Noël</h1>
    <div class="row justify-content-center mt-5 mb-5">

        @foreach ($christmasArticles as $article)
        <div class="card text-center col-md-4 col-lg-3 p-3 m-3\" style="width: 18rem;">
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

<div class="container text-center p-5">
    <h1>Produits stars</h1>
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-4 card" style="width: 18rem;">
            <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="col-md-4 card" style="width: 18rem;">
            <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
        <div class="col-md-4 card" style="width: 18rem;">
            <img src="{{ asset("images/product.png") }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
@endsection