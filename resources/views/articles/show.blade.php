@extends('layouts.app')

@section('title')
Promotions - Laravel Online Store
@endsection


@section('content')

<h2 class='pb-5 text-center'>Détails {{ $article->nom }}</h3>

    <div class="container">
        <div class="row justify-content-center">

            <div class="card text-center col-md-6 p-3 m-3\" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset("images/$article->image") }}" alt="article">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">{{$article->nom}}</h5>
                    <p class="card-text font-italic">{{$article->description}}</p>
                    <p class="card-text font-italic">{{$article->description_detaillee}}</p>
                    <p class="card-text font-weight-light">{{$article->prix}}€</p>

                    <form method="POST" action="{{ route('basket.add', $article) }}" class="form-inline d-inline-block">
                        @csrf
                        <input type="number" name="quantite" placeholder="Quantité ?" class="form-control mr-2">
                        <button type="submit" class="btn btn-warning">+ Ajouter au panier</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>

    @endsection