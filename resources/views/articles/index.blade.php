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

                    @if(in_array($article->id, $campagnesArticlesIds))

                    @php $campagne = GetCampaign($campagnes, $article->id) @endphp

                    <p class="card-text text-danger font-weight-bold">{{$campagne->nom}} : -{{$campagne->reduction}}%</p>
                    <h5 class="card-text font-weight-light"><del>{{$article->prix}} €</del>
                        <span class="text-danger font-weight-bold">
                            @php
                            $newPrice = $article->prix - $article->prix * ($campagne->reduction/100);
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

                    @if(auth()->user()!== null && in_array($articleId, $favorisIds))
                    <!-- si dans les favoris-->
                    <form method="post" action="{{ route('favoris.destroy', $article) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger m-2">Retirer des favoris</button>
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

                    @if ($article->stock !== 0)
                    <form method="POST" action="{{ route('basket.add', $article->id) }}" class="form-inline d-inline-block">
                        @csrf
                        <input type="number" min="1" max="9" name="quantite" class="form-control mr-2" value="{{ isset(session('basket')[$article->id]) ? session('basket')[$article->id]['quantite'] : 1 }}">
                        <button type="submit" class="btn btn-warning">+ Ajouter au panier</button>
                    </form>
                    @endif
                    
                </div>
            </div>

            @endforeach


            @endsection