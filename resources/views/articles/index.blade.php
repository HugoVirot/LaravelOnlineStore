@extends('layouts.app')

@section('title')
Catalogue - Laravel Online Store
@endsection


    @section('content')

<h2 class='pb-5 text-center'>Catalogue</h3>

    <div class="container">
        <div class="row">

            @foreach ($articles as $article)
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


            @endsection