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

                <form action="panier.php" method="post">
                    <input type="hidden" name="chosenArticle" value="{{$article->id}}">
                    <input class="btn btn-dark mt-2\" type="submit" value="Ajouter au panier">
                </form>
            </div>
        </div>

        @endforeach


@endsection