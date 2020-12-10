@extends('layouts.app')

@section('title')
Catalogue - Laravel Online Store
@endsection


@section('content')

<h2 class='pb-5 text-center'>Gammes</h3>

    <div class="container">
        <div class="row">

            @foreach ($gammes as $gamme)

            <div class="container p-5 border border-info">
                <div class="row p-5 justify-content-center">
                    <h4>{{ $gamme->nom}}</h3>
                </div>
                <div class="container">
                    <div class="row">
                        @foreach ($gamme->articles as $article)
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
                    </div>
                </div>
            </div>
            @endforeach

            @endsection