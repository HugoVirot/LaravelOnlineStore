@extends('layouts.app')

@section('title')
Favoris - Laravel Online Store
@endsection


@section('content')

<h2 class='pb-5 text-center'>Mes favoris</h3>

    <div class="container">
        <div class="row">

            @if(count($user->favoris) > 0)
            @foreach ($user->favoris as $article)

            <div class="card text-center col-md-4 col-lg-3 p-3 m-3\" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset("images/$article->image") }}" alt="article">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{$article->nom}}</h5>
                    <p class="card-text font-italic">{{$article->description}}</p>
                    <p class="card-text font-weight-light">{{$article->prix}}€</p>

                    <a href="{{ route('articles.show', $article) }}">
                        <button class="btn btn-info m-2">Détails produit</button>
                    </a>

                    <form method="post" action="{{ route('favoris.destroy') }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger m-2">Retirer des favoris</button>
                        <input type="hidden" value="{{$article->id}}" name="articleId">
                    </form>

                    @if ($article->stock !== 0)
                    <form method="POST" action="{{ route('cart.add', $article->id) }}" class="form-inline d-inline-block">
                        @csrf
                        <input type="number" min="1" max="9" name="quantite" class="form-control mr-2" value="{{ isset(session('cart')[$article->id]) ? session('cart')[$article->id]['quantite'] : null }}">
                        <button type="submit" class="btn btn-warning">+ Ajouter au panier</button>
                    </form>
                    @endif
                    
                </div>
            </div>
            @endforeach
            @else
            <div class="container text-center">
                <h5 class="text-center">Vous n'avez aucun article dans vos favoris.</h5>
            </div>
            @endif
            @endsection